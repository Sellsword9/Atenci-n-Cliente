<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis tickets</title>
  <style>
    <?php include_once "css/styles.css" ?>
  </style>
</head>

<body>
  <?php
  foreach ($ticketsUser as $ticket) {
    echo "<div><h2> #" . $ticket->getId() . ". " . $ticket->getNombre() . "</h2>";
    echo "<p>" . $ticket->getTexto() . "</p>";
    if ($ticket->getEstado() == 2) {
      foreach ($ticket->getRespuestas($db) as $r) {
        echo "<p>" . $r . "</p>";
      }
      echo "<p>(Ticket cerrado)</p>";
      echo "<form action='index.php' method='post'>";
      echo "<input type='hidden' name='valorarid' value='" . $ticket->getId() . "'>";
      echo "<label for='ticketvaloracion'>Valoración: </label>";
      echo "<select name='ticketvaloracion' id='ticketvaloracion'>";
      echo "<option value='1'>Deficiente</option>";
      echo "<option value='2'>Decepcionante</option>";
      echo "<option value='3'>Aceptable</option>";
      echo "<option value='4'>Bueno</option>";
      echo "<option value='5'>Excelente</option>";
      echo "</select>";
      echo "<input type='submit' value='Valorar ticket'></form></div>";
    } else if ($ticket->getEstado() == 3) {

      foreach ($ticket->getRespuestas($db) as $r) {
        echo "<p>" . $r . "</p>";
      }
      echo "<p>(Ticket cerrado)</p>";
      echo "<h3>Gracias por valorar nuestro servicio!</h3></div>";
    } else if ($ticket->getTrabajador() != null) {

      foreach ($ticket->getRespuestas($db) as $r) {
        echo "<p>" . $r . "</p>";
      }
      echo "<form method='post' action='index.php'>";
      echo "<input type='hidden' name='ticketid' value='" . $ticket->getId() . "'>";
      echo "<input type='text' name='ticketrespuesta' placeholder='Respuesta'>";
      echo "<input type='submit' value='Responder'>";
    } else {
      echo "<p>(Ticket aún no respondido. Nuestro servicio le atenderá asap!)</p></div>";
    }
  }
  ?>
  <a href="index.php">Volver al inicio</a>
</body>

</html>