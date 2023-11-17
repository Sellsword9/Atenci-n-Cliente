<?php
$db = Conectar::conexion();
require_once("model/user.php");
require_once("model/ticket.php");
require_once("model/ticketRepository.php");
session_start();

if (isset($_GET)) {
  isset($_GET['registro']) && incluirRegistro(); //Equivale a SI existe $_GET['registro'] INCLUYE register.php
  isset($_GET['logout']) && destruirSesion();
  isset($_GET['verTickets']) && verTickets($db);
}
if (isset($_POST)) {
  isset($_POST['newusername']) && isset($_POST['newpassword']) && registrarUsuario($db);
  isset($_POST['username']) && isset($_POST['password']) && logearUsuario($db);
  isset($_POST['tickettitulo']) && isset($_POST['ticketdescripcion']) && createTicket($db);
  isset($_POST['atenderid']) && atenderTicket($db);
  isset($_POST['ticketid']) && responderTicket($db);
  isset($_POST['cerrarid']) && cerrarTicket($db);
  isset($_POST['valorarid']) && valorarTicket($db, $_POST['valorarid'], $_POST['ticketvaloracion']);
}

if (!isset($_SESSION) || empty($_SESSION['usuario'])) {
  include_once("view/login.php");
  die();
} else {
  $usuario = $_SESSION['usuario'];
  $username = $usuario->getNombre();
  $sql = "SELECT * FROM usuarios WHERE nombre = '$username'";
  $resultado = $db->query($sql);
  $row = $resultado->fetch_assoc();
  switch ($row['rol']) {
    case -1:
      echo ("usuario baneado <a href='index.php?logout'>Salir</a>");
      die();
    case 2:
      // var_dump("admin mode");
      include_once("controller/adminController.php");
    case 1:
      trabajarTickets($db);
      die();
    default:
      include_once("view/main.php");
  }
}



function incluirRegistro()
{
  include_once("view/register.php");
  die();
}
function registrarUsuario($db)
{
  $username = $_POST['newusername'];
  $password = $_POST['newpassword'];
  $sql = "INSERT INTO usuarios (nombre, contraseña, rol) VALUES ('$username', '$password', 0)";
  $db->query($sql);
  header("Location: index.php");
}
function logearUsuario($db)
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM usuarios WHERE nombre = '$username' AND contraseña = '$password'";
  $resultado = $db->query($sql);
  if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $_SESSION['usuario'] = new usuario($row);
    header("Location: index.php");
  } else {
    echo "Usuario o contraseña incorrectos";
  }
  die();
}
function destruirSesion()
{
  session_destroy();
  include_once("view/login.php");
  die();
}
function createTicket($db)
{
  $titulo = $_POST['tickettitulo'];
  $descripcion = $_POST['ticketdescripcion'];
  $usuarioid = $_SESSION['usuario']->getId();
  TicketRepository::createTicket($db, $titulo, $descripcion, $usuarioid);
  verTickets($db);
  die();
}
function verTickets($db)
{
  $usuarioid = $_SESSION['usuario']->getId();
  $sql = "SELECT * FROM ticket WHERE id_cliente = $usuarioid";
  $resultado = $db->query($sql);
  $ticketsUser = [];
  while ($row = $resultado->fetch_assoc()) {
    $ticketsUser[] =
      new Ticket(
        $row['id'],
        $row['nombre'],
        $row['texto'],
        $row['id_cliente'],
        $row['id_trabajador'],
        $row['estado']
      );
  }
  include_once("view/myTickets.php");
  die();
}
function trabajarTickets($db)
{
  if ($_SESSION['usuario']->getRol() < 1 || empty($_SESSION['usuario'])) {
    die(); // Por si acaso
  }
  $ticketsDesantendidos = TicketRepository::getTicketsDesatendidos($db);
  $misTickets = TicketRepository::getTicketsTrabajador($db, $_SESSION['usuario']->getId());
  include_once("view/atender.php");
  die();
}
function atenderTicket($db)
{
  if ($_SESSION['usuario']->getRol() < 1 || empty($_SESSION['usuario'])) {
    die(); // Por si acaso
  }
  TicketRepository::atenderTicket($db, $_POST['atenderid'], $_SESSION['usuario']->getId(), $_POST['atenderrespuesta']);
}
function responderTicket($db)
{
  if (empty($_SESSION['usuario'])) {
    die(); // Por si acaso
  }
  TicketRepository::responderTicket($db, $_POST['ticketid'], $_SESSION['usuario']->getId(), $_POST['ticketrespuesta']);
}
function cerrarTicket($db)
{
  if ($_SESSION['usuario']->getRol() < 1 || empty($_SESSION['usuario'])) {
    die(); // Por si acaso
  }
  TicketRepository::cerrarTicket($db, $_POST['cerrarid']);
}
function valorarTicket($db, $idticket, $valoracion)
{
  $sql = "insert into valoraciones (id_ticket, valoracion) values ($idticket, $valoracion)";
  $db->query($sql);
  $sql = "update ticket set estado = 3 where id = $idticket";
  $db->query($sql);
}
