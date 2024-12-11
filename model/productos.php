<?php

class Productos
{
  private $id;
  private $nombre;
  private $descripcion;
  private $precio;
  private $stock;
  private $estado;
  private $oferta;
  private $offerExpiration;
  private $imagenes;
  private $parentid;
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  //// GETTERS ////

  public function getId()
  {
    return $this->id;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function getDescripcion()
  {
    return $this->descripcion;
  }

  public function getPrecio()
  {
    return $this->precio;
  }

  public function getStock()
  {
    return $this->stock;
  }

  public function getEstado()
  {
    return $this->estado;
  }

  public function getOferta()
  {
    return $this->oferta;
  }

  public function getOfferExpiration()
  {
    return $this->offerExpiration;
  }

  public function getImagenes()
  {
    return $this->imagenes;
  }

  public function getParentId()
  {
    return $this->parentid;
  }

  //// SETTER //// 

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  public function setDescripcion($descripcion)
  {
    $this->descripcion = $descripcion;
  }

  public function setPrecio($precio)
  {
    $this->precio = $precio;
  }

  public function setStock($stock)
  {
    $this->stock = $stock;
  }

  public function setEstado($estado)
  {
    $this->estado = $estado;
  }

  public function setOferta($oferta)
  {
    $this->oferta = $oferta;
  }

  public function setOfferExpiration($offerExpiration)
  {
    $this->offerExpiration = $offerExpiration;
  }

  public function setImagenes($imagenes)
  {
    $this->imagenes = $imagenes;
  }

  public function setParentId($parentid)
  {
    $this->parentid = $parentid;
  }

 //// CONSULTAS ////

  public function save()
  {
    $imagenesJson = json_encode($this->imagenes);
    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, estado, oferta, offer_expiration, imagenes, parent_id) 
              VALUES (
                  '{$this->getNombre()}', 
                  '{$this->getDescripcion()}', 
                  '{$this->getPrecio()}', 
                  '{$this->getStock()}', 
                  '{$this->getEstado()}', 
                  '{$this->getOferta()}', 
                  '{$this->getOfferExpiration()}', 
                  '$imagenesJson',
                  {$this->getParentId()}
              )";

    return $this->db->query($sql);
  }

  public function getAll()
  {
    $sql = "SELECT * FROM productos";
    $result = $this->db->query($sql);
    $productos = [];
    while ($row = $result->fetch_object()) {
      $productos[] = $row;
    }
    return $productos;
  }

  public function obtenerProductosPorId()
  {
    if (!$this->getId()) {
      return null;
    }
    $sql = "SELECT * FROM productos WHERE id = {$this->getId()}";
    $result = $this->db->query($sql);
    if ($result && $result->num_rows > 0) {
      return $result->fetch_object();
    }
    return null;
  }

  public function actualizarProductosPorId()
  {
    $campos = [
      "nombre = '{$this->getNombre()}'",
      "descripcion = '{$this->getDescripcion()}'",
      "precio = '{$this->getPrecio()}'",
      "stock = '{$this->getStock()}'",
      "estado = '{$this->getEstado()}'",
      "oferta = '{$this->getOferta()}'",
      "offer_expiration = '{$this->getOfferExpiration()}'",
      "parent_id = {$this->getParentId()}"
    ];
    if ($this->getImagenes()) {
      $campos[] = "imagenes = '{$this->getImagenes()}'";
    }
    $campos_sql = implode(", ", $campos);
    $sql = "UPDATE productos SET $campos_sql WHERE id = {$this->getId()}";
    return $this->db->query($sql);
  }

  public function eliminarProductos()
  {
    $sql = "DELETE FROM productos WHERE id = {$this->getId()}";
    return $this->db->query($sql);
  }

  public function addImagen($imagen)
  {
    if (!$this->imagenes) {
      $this->imagenes = [];
    }
    $this->imagenes[] = $imagen;
  }
}
