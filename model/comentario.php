<?php

class Comentario
{

    private $id;
    private $estado;
    private $comentario;
    private $calificacion;
    private $producto_id;
    private $usuario_id;
    private $parentId;
    private $grupoId;
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

    public function getEstado()
    {
        return $this->estado;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function getCalificacion()
    {
        return $this->calificacion;
    }

    public function getProducto_id()
    {
        return $this->producto_id;
    }

    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function getGrupoId()
    {
        return $this->grupoId;
    }


    //// SETTERS ////

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }

    public function setProducto_id($producto_id)
    {
        $this->producto_id = $producto_id;
    }

    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    public function setGrupoId($grupoId)
    {
        $this->grupoId = $grupoId;
    }

    //// CONSULTAS //// 

    public function guardar()
    {
        $sql = "INSERT INTO comentarios (comentario, calificacion, usuario_id, estado, parent_id, grupo_id) 
                VALUES ('{$this->getComentario()}', {$this->getCalificacion()}, {$this->getUsuario_id()}, 0, {$this->getParentId()}, {$this->getGrupoId()})";
        $save = $this->db->query($sql);
        return $save;
    }

    public function obtenerComentariosValorados($idProducto)
    {
        $sql = "SELECT comentarios.*, usuarios.Usuario AS Usuario
                FROM comentarios
                INNER JOIN usuarios ON comentarios.usuario_id = usuarios.Id
                -- WHERE comentarios.producto_id = $idProducto AND comentarios.estado = 1
                ORDER BY comentarios.calificacion DESC";
        $result = $this->db->query($sql);
        return $result;
    }

    public function obtenerComentariosMenorCalificacion($idProducto)
    {
        $sql = "SELECT comentarios.*, usuarios.Usuario AS Usuario
                FROM comentarios
                INNER JOIN usuarios ON comentarios.usuario_id = usuarios.Id
                -- WHERE comentarios.producto_id = $idProducto AND comentarios.estado = 1
                ORDER BY comentarios.calificacion ASC";
        $result = $this->db->query($sql);
        return $result;
    }

    public function cambiarEstadoComentario()
    {
        $estado = ($this->getEstado() === 'pendiente') ? 'aprobado' : 'pendiente';
        $sql = "UPDATE comentarios SET estado = '{$this->getEstado()}' WHERE id = {$this->getId()}";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getComentarios()
    {
        $sql = "SELECT co.id, u.Id AS usuario_id, u.Usuario AS nombre_usuario, u.Email AS email_usuario, u.Nombres AS nombres, u.Apellidos AS apellidos, co.id AS comentario_id, co.comentario, co.calificacion, co.fecha, co.estado, p.nombre AS nombre_producto
                FROM comentarios co LEFT JOIN usuarios u ON co.usuario_id = u.Id
                LEFT JOIN productos p ON p.grupo_id = co.grupo_id WHERE p.idioma_id = 1;";
        $result = $this->db->query($sql);
        return $result;
    }

    public function obtenerPromedioCalificacion($idProducto)
    {
        $sql = "SELECT AVG(calificacion) AS promedio FROM comentarios WHERE parent_id = $idProducto AND estado = 1";

        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_object();
            return $row->promedio;
        }
        return 0;
    }
}
