<?php
require_once("model/ticket.php");
require_once("model/userRepository.php");
require_once("model/user.php");
class TicketRepository
{
  public static function getTickets()
  {
    $conexion = Conectar::conexion();
    $sql = "SELECT * FROM ticket";
    $result = $conexion->query($sql);
    $tickets = [];
    while ($row = $result->fetch_assoc()) {
      $tickets[] = $row;
    }
    return $tickets;
  }
  public static function getTicket($id)
  {
    $conexion = Conectar::conexion();
    $sql = "SELECT * FROM ticket WHERE id = $id";
    $result = $conexion->query($sql);
    $row = $result->fetch_assoc();
    return $row;
  }
  public static function createTicket($db, $titulo, $descripcion, $cliente)
  {
    $sql = "INSERT INTO ticket (nombre, texto, id_cliente) VALUES ('$titulo', '$descripcion', '$cliente')";
    $db->query($sql);
  }
  public static function getTicketsDesatendidos($db)
  {
    $tickets = [];
    $sql = "SELECT * FROM ticket WHERE id_trabajador IS NULL";
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
      $tickets[] = new Ticket($row['id'], $row['nombre'], $row['texto'], $row['id_cliente']);
    }
    return $tickets;
  }
  public static function getTicketsTrabajador($db, $trabajadorid)
  {
    $tickets = [];
    $sql = "SELECT * FROM ticket WHERE id_trabajador = $trabajadorid AND estado = 1";
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
      $tickets[] = new Ticket($row['id'], $row['nombre'], $row['texto'], $row['id_cliente']);
    }
    return $tickets;
  }
  public static function atenderTicket($db, $ticketid, $trabajadorid, $resp)
  {
    $nombreTrabajador = UserRepository::getNombreDe($db, $trabajadorid);
    $resp = $nombreTrabajador . " comentó: " . $resp;
    $sql = "UPDATE ticket SET id_trabajador = $trabajadorid WHERE id = $ticketid";
    $db->query($sql);
    $sql = "Update ticket SET estado = 1 WHERE id = $ticketid";
    $db->query($sql);
    self::responderTicket($db, $ticketid, $trabajadorid, $resp);
  }
  public static function responderTicket($db, $ticketid, $userId, $resp)
  {
    $sql = "INSERT INTO respuestas (id_ticket, id_autor, texto) VALUES ($ticketid, $userId, '$resp')";
    $db->query($sql);
  }
  public static function cerrarTicket($db, $ticketid)
  {
    $sql = "UPDATE ticket SET estado = 2 WHERE id = $ticketid";
    $db->query($sql);
  }
  public static function getTicketsCerrados($db)
  {
    $tickets = [];
    $sql = "SELECT * FROM ticket WHERE estado = 2";
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
      $tickets[] = new Ticket($row['id'], $row['nombre'], $row['texto'], $row['id_cliente'], $row['id_trabajador'], $row['estado']);
    }
    return $tickets;
  }
  public static function getTicketsValorados($db)
  {
    $tickets = [];
    $sql = "SELECT * FROM ticket WHERE estado = 3";
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
      $tickets[] = new Ticket($row['id'], $row['nombre'], $row['texto'], $row['id_cliente'], $row['id_trabajador'], $row['estado']);
    }
    return $tickets;
  }
  public static function getTicketsAbiertos($db)
  {
    $tickets = [];
    $sql = "SELECT * FROM ticket WHERE estado = 1";
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
      $tickets[] = new Ticket($row['id'], $row['nombre'], $row['texto'], $row['id_cliente'], $row['id_trabajador'], $row['estado']);
    }
    return $tickets;
  }
}
