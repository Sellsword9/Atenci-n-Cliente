<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de administración</title>
</head>

<body>
  <!-- $ticketsDesantendidos = TicketRepository::getTicketsDesatendidos($db);
  $ticketsAtendidos = TicketRepository::getTicketsAbiertos($db);
  $ticketsCerrados = TicketRepository::getTicketsCerrados($db);
  $ticketsValorados = TicketRepository::getTicketsValorados($db); -->
  <h1>Tickets desatendidos</h1>
  <?php
  foreach ($ticketsDesantendidos as $ticket) {
    echo "<div>";
    echo "<h3>" . $ticket->getNombre() . "</h3>";
    echo "<p>" . $ticket->getTexto() . "</p>";
    echo "<p>Cliente: " . $ticket->getNombreCliente($db) . "</p>";
    echo "</div>";
  }
  ?>
  <h1>Tickets abiertos</h1>
  <?php
  foreach ($ticketsAtendidos as $ticket) {
    echo "<div>";
    echo "<h3>" . $ticket->getNombre() . "</h3>";
    echo "<p>" . $ticket->getTexto() . "</p>";
    echo "<p>Cliente: " . $ticket->getNombreCliente($db) . "</p>";
    foreach ($ticket->getRespuestas($db) as $r) {
      echo "<p>" . $r . "</p>";
    }
  } ?>
  <h1>Tickets cerrados</h1>
  <?php
  foreach ($ticketsCerrados as $ticket) {
    echo "<div>";
    echo "<h3>" . $ticket->getNombre() . "</h3>";
    echo "<p>" . $ticket->getTexto() . "</p>";
    echo "<p>Cliente: " . $ticket->getNombreCliente($db) . "</p>";
    foreach ($ticket->getRespuestas($db) as $r) {
      echo "<p>" . $r . "</p>";
    }
  }
  ?>
  <h1>Tickets valorados</h1>
  <?php
  foreach ($ticketsValorados as $ticket) {
    echo "<div>";
    echo "<h3>" . $ticket->getNombre() . "</h3>";
    echo "<p>" . $ticket->getTexto() . "</p>";
    echo "<p>Cliente: " . $ticket->getNombreCliente($db) . "</p>";
    foreach ($ticket->getRespuestas($db) as $r) {
      echo "<p>" . $r . "</p>";
    }
    echo "<p>Valoración: " . $ticket->getValoracion($db) . "</p>";
    echo "</div>";
  } ?>
  <h1>Usuarios</h1>
  <?php
  foreach ($usuarios as $usuario) {
    if ($usuario->getRol() > -1) {
      echo "<div>";
      echo "<h3>" . $usuario->getNombre() . "</h3>";
      echo "<p>" . $usuario->getRol() . "</p>";
      echo "<form method='post' action='index.php'>";
      echo "<input type='hidden' name='eliminarid' value='" . $usuario->getId() . "'>";
      echo "<input type='submit' value='Eliminar'>";
      echo "</form>";
      echo "<form method='post' action='index.php'>";
      echo "<input type='hidden' name='modificarid' value='" . $usuario->getId() . "'>";
      echo "<input type='text' name='modificarrol' placeholder='Rol'>";
      echo "<input type='submit' value='Modificar'>";
      echo "</div>";
    }
  } ?>

  <a href="index.php?logout">Cerrar sesión</a>
</body>

</html>