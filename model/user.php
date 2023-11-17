<?php
class Usuario
{
  private $id;
  private $nombre;
  private $rol; // Puedes usar esto para distinguir entre clientes y trabajadores

  public function __construct($datos)
  {
    $this->id = $datos['id'];
    $this->nombre = $datos['nombre'];
    $this->rol = $datos['rol'];
  }

  public function getId()
  {
    return $this->id;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function getRol()
  {
    return $this->rol;
  }
}
