<?php
class Ticket
{
  private $id;
  private $nombre;
  private $texto;
  private $cliente; // Usuario que creó el ticket
  private $trabajador; // Usuario que respondió al ticket
  private $estado; // 0 = sin responder, 1 = respondido, 2 = cerrado

  public function __construct($id, $nombre, $texto, $cliente, $trabajador = null, $estado = 0)
  {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->texto = $texto;
    $this->cliente = $cliente;
    $this->trabajador = $trabajador;
    if ($estado != 0) {
      $this->estado = $estado;
    } else {
      $this->estado = $trabajador == null ? 0 : 1;
    }
  }

  public function getId()
  {
    return $this->id;
  }

  public function getnombre()
  {
    return $this->nombre;
  }

  public function getTexto()
  {
    return $this->texto;
  }

  public function getCliente()
  {
    return $this->cliente;
  }
  public function getNombreCliente($db)
  {
    return userRepository::getNombreDe($db, $this->cliente);
  }
  public function getTrabajador()
  {
    return $this->trabajador;
  }
  public function getEstado()
  {
    return $this->estado;
  }

  public function responder($trabajador)
  {
    $this->trabajador = $trabajador;
  }
  public function getRespuestas($db)
  {
    $sql = "SELECT * FROM respuestas WHERE id_ticket = $this->id";
    $result = $db->query($sql);
    $respuestas = [];
    while ($row = $result->fetch_assoc()) {
      $respuestas[] = $row['texto'];
    }
    return $respuestas;
  }

  public function getValoracion($db)
  {
    $sql = "SELECT * FROM valoraciones WHERE id_ticket = $this->id";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    return $row['valoracion'];
  }
}
