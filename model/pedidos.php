<?php

class Pedidos
{

  private $id;
  private $usuario_id;
  private $pais;
  private $ciudad;
  private $direccion;
  private $codigoPostal;
  private $coste;
  private $estado;
  private $fecha;
  private $hora;
  private $db;

  ///CONSTRUCTOR///
  public function __construct()
  {
    $this->db = Database::connect();
  }

  //// GETTER //// 
  public function getId()
  {
    return $this->id;
  }

  public function getUsuario_id()
  {
    return $this->usuario_id;
  }

  public function getPais()
  {
    return $this->pais;
  }

  public function getCiudad()
  {
    return $this->ciudad;
  }

  public function getDireccion()
  {
    return $this->direccion;
  }

  public function getCodigoPostal()
  {
    return $this->codigoPostal;
  }

  public function getCoste()
  {
    return $this->coste;
  }

  public function getEstado()
  {
    return $this->estado;
  }

  public function getfecha()
  {
    return $this->fecha;
  }

  public function getHora()
  {
    return $this->hora;
  }

  //// SETTER //// 
  public function setId($id)
  {
    $this->id = $id;
  }

  public function setUsuario_id($usuario_id)
  {
    $this->usuario_id = $usuario_id;
  }

  public function setPais($pais)
  {
    $this->pais = $pais;
  }

  public function setCiudad($ciudad)
  {
    $this->ciudad = $ciudad;
  }

  public function setDireccion($direccion)
  {
    $this->direccion = $direccion;
  }

  public function setCodigoPostal($codigoPostal)
  {
    $this->codigoPostal = $codigoPostal;
  }

  public function setCoste($coste)
  {
    $this->coste = $coste;
  }

  public function setEstado($estado)
  {
    $this->estado = $estado;
  }

  public function setFecha($fecha)
  {
    $this->fecha = $fecha;
  }

  public function setHora($hora)
  {
    $this->hora = $hora;
  }

  //// CONSULTAS //// 
  public function guardar()
  {
    $result = false;

    $sql = "INSERT INTO pedidos (id, usuario_id, pais, ciudad, direccion, codigoPostal, coste, estado, fecha, hora) VALUES (null, {$this->getUsuario_id()}, '{$this->getPais()}', '{$this->getCiudad()}', '{$this->getDireccion()}', '{$this->getCodigoPostal()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
    $save = $this->db->query($sql);

    // echo $sql;
    // die();
    // echo "</br>";
    // echo $this->db->error;
    // die();

    if ($save) {
      $result = true;
    }

    return $result;
  }
}
