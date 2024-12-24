<?php

class Usuario
{
  private $id;
  private $usuario;
  private $password;
  private $numeroDocumento;
  private $nombres;
  private $apellidos;
  private $email;
  private $nroTelefono;
  private $direccion;
  private $codigoPostal;
  private $pais;
  private $idEstado;
  private $ciudad;
  private $imagen;
  private $url_Documento;
  private $rol;
  private $db;

  public function __construct()
  {
    $this->db = Database::connect();
  }

  //// GETTER //// 

  public function getId()
  {
    return $this->id;
  }

  public function getUsuario()
  {
    return $this->usuario;
  }

  public function getPassword()
  {
    return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
  }

  public function getNumeroDocumento()
  {
    return $this->numeroDocumento;
  }

  public function getNombres()
  {
    return $this->nombres;
  }

  public function getApellidos()
  {
    return $this->apellidos;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getNroTelefono()
  {
    return $this->nroTelefono;
  }

  public function getDireccion()
  {
    return $this->direccion;
  }

  public function getCodigoPostal()
  {
    return $this->codigoPostal;
  }

  public function getPais()
  {
    return $this->pais;
  }

  public function getIdEstado()
  {
    return $this->idEstado;
  }

  public function getCiudad()
  {
    return $this->ciudad;
  }

  public function getImagen()
  {
    return $this->imagen;
  }

  public function getUrlDocumento()
  {
    return $this->url_Documento;
  }

  public function getRol()
  {
    return $this->rol;
  }

  //// SETTER //// 

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setUsuario($usuario)
  {
    $this->usuario = $usuario;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function setNumeroDocumento($numeroDocumento)
  {
    $this->numeroDocumento = $numeroDocumento;
  }

  public function setNombres($nombres)
  {
    $this->nombres = $nombres;
  }

  public function setApellidos($apellidos)
  {
    $this->apellidos = $apellidos;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setNroTelefono($nroTelefono)
  {
    $this->nroTelefono = $nroTelefono;
  }

  public function setDireccion($direccion)
  {
    $this->direccion = $direccion;
  }

  public function setCodigoPostal($codigoPostal)
  {
    $this->codigoPostal = $codigoPostal;
  }

  public function setPais($pais)
  {
    $this->pais = $pais;
  }

  public function setIdEstado($idEstado)
  {
    $this->idEstado = $idEstado;
  }

  public function setCiudad($ciudad)
  {
    $this->ciudad = $ciudad;
  }

  public function setImagen($imagen)
  {
    $this->imagen = $imagen;
  }

  public function setUrlDocumento($url_Documento)
  {
    $this->url_Documento = $url_Documento;
  }

  public function setRol($rol)
  {
    $this->rol = $rol;
  }

  //// CONSULTAS ////

  public function crear()
  {
    $result = false;

    $sql = "INSERT INTO usuarios (Usuario,
                                  Password,
                                  Email)";

    $sql .= "VALUES ('{$this->usuario}',
                    '{$this->getPassword()}',    
                    '{$this->email}')";

    $save = $this->db->query($sql);

    return $result;
  }

  public function iniciarSesion()
  {
    $resultado = false;
    $sql = "SELECT * FROM usuarios where Email ='{$this->getEmail()}'";
    $login = $this->db->query($sql);
    if ($login && $login->num_rows == 1) {
      $usuario = $login->fetch_object();
      $vericacion = password_verify($this->password, $usuario->Password);
      if ($vericacion == 1) {
        return $usuario;
      }
    }
    return $resultado;
  }

  public function repetidosUsuario()
  {
    $resultado = false;
    $sql = "SELECT Usuario FROM usuarios WHERE Usuario = '{$this->usuario}'";
    $repetidos = $this->db->query($sql);
    if ($repetidos) {
      $resultado = true;
    }
    return $repetidos;
  }

  public function repetidosEmail()
  {
    $resultado = false;
    $sql = "SELECT Email FROM usuarios WHERE Email = '{$this->email}' AND Id != '{$this->id}'";
    $repetidos = $this->db->query($sql);
    if ($repetidos && $repetidos->num_rows > 0) {
      $resultado = true;
    }
    return $repetidos;
  }

  public function subirImagen()
  {
    $resultado = false;
    $sql = "UPDATE usuarios SET imagen = '{$this->imagen}' WHERE Id = {$this->id}";
    $imagenSubida = $this->db->query($sql);
    if ($imagenSubida) {
      $resultado = true;
    }
    return $resultado;
  }

  public function actualizar()
  {
    $resultado = false;
    $sql = "UPDATE usuarios SET 
              Usuario = '{$this->usuario}',
              NumeroDocumento = '{$this->numeroDocumento}', 
              Nombres = '{$this->nombres}', 
              Apellidos = '{$this->apellidos}', 

              
              NroTelefono = '{$this->nroTelefono}', 
              Direccion = '{$this->direccion}', 
              Pais = '{$this->pais}', 
              Ciudad = '{$this->ciudad}', 
              CodigoPostal = '{$this->codigoPostal}' 
            WHERE Id = {$this->id}";
    $actualizar = $this->db->query($sql);
    if ($actualizar) {
      $resultado = true;
    }
    return $resultado;
  }

  public function obtenerTodosPorId()
  {
    $resultado = false;
    $sql = "SELECT * FROM usuarios WHERE Id = {$this->id}";
    $obtenerTodos = $this->db->query($sql);
    if ($obtenerTodos) {
      $resultado = true;
    }
    return $obtenerTodos->fetch_object();
  }

  public function actualizarPassword()
  {
    $sql = "UPDATE usuarios SET Password = '{$this->password}' WHERE Id = {$this->id}";
    $resultado = $this->db->query($sql);
    return $resultado;
  }

  public function actualizarRol()
  {
    $sql = "UPDATE usuarios SET Rol = '{$this->rol}' WHERE Id = {$this->id}";
    $resultado = $this->db->query($sql);
    return $resultado;
  }

  public function obtenerTodosLosUsuarios()
  {
    $sql = "SELECT * FROM usuarios";
    $resultado = $this->db->query($sql);

    return $resultado;
  }

  public function existeUsuarioConRol1()
  {
    $sql = "SELECT COUNT(*) AS count FROM usuarios WHERE Rol = 1";
    $result = $this->db->query($sql);
    $data = $result->fetch_object();
    return $data->count > 0;
  }

  public function obtenerTotalClientes()
  {
    $sql = "SELECT COUNT(*) AS total_clientes FROM usuarios";
    $query = $this->db->query($sql);

    if ($query && $row = $query->fetch_object()) {
      return $row->total_clientes;
    }

    return 0;
  }
  
}
