<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zona de atención al cliente</title>
</head>

<body>
  <div>
    <h1> Tickets en curso </h1>
    <?php
    foreach ($misTickets as $ticket) {
      echo "<div>";
      echo "<h3>" . $ticket->getNombre() . "</h3>";
      echo "<p>" . $ticket->getTexto() . "</p>";
      echo "<p>Cliente: " . $ticket->getNombreCliente($db) . "</p>";
      foreach ($ticket->getRespuestas($db) as $r) {
        echo "<p>" . $r . "</p>";
      }
      echo "<form method='post' action='index.php'>";
      echo "<input type='hidden' name='atenderid' value='" . $ticket->getId() . "'>";
      echo "<input type='text' name='atenderrespuesta' placeholder='Responder'>";
      echo "<input type='submit' value='Responder'>";
      echo "</form>";
      echo "<form method='post' action='index.php'>";
      echo "<input type='hidden' name='cerrarid' value='" . $ticket->getId() . "'>";
      echo "<input type='submit' value='Cerrar ticket'>";
      echo "</div>";
    }
    ?>
    <h1> Tickets abiertos </h1>
    <?php
    foreach ($ticketsDesantendidos as $ticket) {
      echo "<div>";
      echo "<h3>" . $ticket->getNombre() . "</h3>";
      echo "<p>" . $ticket->getTexto() . "</p>";
      echo "<p>Cliente: " . $ticket->getNombreCliente($db) . "</p>";
      echo "<form method='post' action='index.php'>";
      echo "<input type='hidden' name='atenderid' value='" . $ticket->getId() . "'>";
      echo "<input type='text' name='atenderrespuesta' placeholder='Respuesta'>";
      echo "<input type='submit' value='Atender'>";
      echo "</form>";
      echo "</div>";
    }
    ?>
  </div>
  <a href="index.php?logout">Cerrar sesión</a>
</body>

</html>