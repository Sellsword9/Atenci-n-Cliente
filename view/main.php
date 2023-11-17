<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atención al cliente</title>
  <style>
    <?php include_once "css/styles.css" ?>
  </style>
</head>

<body>
  <h1>Bienvenido, <?php echo $_SESSION['usuario']->getNombre(); ?>!</h1>
  <a href="index.php?logout">Cerrar sesión</a>
  <p>Por favor, completa el formulario para enviar un nuevo ticket:</p>

  <form action="index.php" method="post">
    <label for="titulo">Título del Ticket:</label>
    <input type="text" id="titulo" name="tickettitulo" required>
    <br>

    <label for="descripcion">Descripción del Ticket:</label>
    <textarea id="descripcion" name="ticketdescripcion" rows="4" required></textarea>
    <br>

    <input type="submit" value="Enviar Ticket">
  </form>
  <a href="index.php?verTickets">Ver tickets enviados</a>
</body>

</html>