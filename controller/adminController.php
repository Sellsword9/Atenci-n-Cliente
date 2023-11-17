<?php
require_once("model/ticketRepository.php");

if (empty($_SESSION['usuario']) || $_SESSION['usuario']->getRol() < 2) {
  var_dump("admin mode not enabled");
  die();
} else {
  if (isset($_POST)) {
    isset($_POST['eliminarid']) && eliminarUser($db, $_POST['eliminarid']);
    isset($_POST['modificarid']) && modificarRol($db, $_POST['modificarid'], $_POST['modificarrol']);
  }
  // var_dump("admin mode enabled");
  $ticketsDesantendidos = TicketRepository::getTicketsDesatendidos($db);
  $ticketsAtendidos = TicketRepository::getTicketsAbiertos($db);
  $ticketsCerrados = TicketRepository::getTicketsCerrados($db);
  $ticketsValorados = TicketRepository::getTicketsValorados($db);
  $usuarios = UserRepository::getAllUsers($db);
  include_once("view/admin.php");
  die();
}
function eliminarUser($db, $id)
{
  if (empty($_SESSION['usuario']) || $_SESSION['usuario']->getRol() < 2) {
    die(); // extra security
  }
  $id = $_POST['eliminarid'];
  $sql = "UPDATE usuarios SET rol = -1 WHERE id = $id";
  $db->query($sql);
}
function modificarRol($db, $idUser, $rol)
{
  if (empty($_SESSION['usuario']) || $_SESSION['usuario']->getRol() < 2) {
    die(); // extra security
  }
  $sql = "UPDATE usuarios SET rol = $rol WHERE id = $idUser";
  $db->query($sql);
}
