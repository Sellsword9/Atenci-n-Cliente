<?php
require_once("user.php");
class userRepository
{
  public static function getNombreDe($db, $id_user): string
  {
    $sql = "SELECT * FROM usuarios WHERE id = $id_user";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    return (new Usuario($row))->getNombre();
  }
  public static function getAllUsers($db)
  {
    $sql = "SELECT * FROM usuarios";
    $result = $db->query($sql);
    $usuarios = [];
    while ($row = $result->fetch_assoc()) {
      $usuarios[] = new Usuario($row);
    }
    return $usuarios;
  }
}
