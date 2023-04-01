<?php

require_once "connection.php";
require_once "Ciudadano.php";

class CiudadanoDAO
{

    public function __construct()
    {
        $this->db = connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM ciudadanos";
        $result = mysqli_query($this->db, $sql);
        $ciudadanos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $ciudadanos;
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM ciudadanos WHERE id = $id";
        $result = mysqli_query($this->db, $sql);
        $ciudadano = mysqli_fetch_assoc($result);
        return $ciudadano;
    }

    public function getByAnyField($data)
    {
        $sql = "SELECT * FROM ciudadanos WHERE nombre LIKE '%{$data['nombre']}%' OR direccion LIKE '%{$data['direccion']}%' OR telefono LIKE '%{$data['telefono']}%'";
        $result = mysqli_query($this->db, $sql);
        $ciudadanos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $ciudadanos;
    }

    public function getByName($name)
    {
        $sql = "SELECT * FROM ciudadanos WHERE nombre LIKE '%{$name}%'";
        $result = mysqli_query($this->db, $sql);
        $ciudadanos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $ciudadanos;
    }

    public function set($data)
    {
        $sql = "INSERT INTO ciudadanos (nombre, contraseña, direccion, telefono) VALUES ('{$data['nombre']}', '{$data['password']}', '{$data['direccion']}', '{$data['telefono']}')";
        $result = mysqli_query($this->db, $sql);
        if ($result) {
            $this->mensaje = "Ciudadano creado correctamente";
        } else {
            $this->mensaje = "Error al crear ciudadano";
        }
    }

    public function edit($data)
    {
        $sql = "UPDATE ciudadanos SET nombre = '{$data['nombre']}', contraseña = '{$data['password']}', direccion = '{$data['direccion']}', telefono = '{$data['telefono']}' WHERE id_ciudadano = {$data['id']}";
        $result = mysqli_query($this->db, $sql);
        if ($result) {
            $this->mensaje = "Ciudadano editado correctamente";
        } else {
            $this->mensaje = "Error al editar ciudadano";
        }
    }

    public function editEs_entrenador($data)
    {
        $sql = "UPDATE ciudadanos SET es_entrenador = '{$data['es_entrenador']}' WHERE id_ciudadano = {$data['id']}";
        $result = mysqli_query($this->db, $sql);
        if ($result) {
            $this->mensaje = "Ciudadano editado correctamente";
        } else {
            $this->mensaje = "Error al editar ciudadano";
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM ciudadanos WHERE id_ciudadano = $id";
        $result = mysqli_query($this->db, $sql);
        if ($result) {
            $this->mensaje = "Ciudadano eliminado correctamente";
        } else {
            $this->mensaje = "Error al eliminar ciudadano";
        }
    }
}