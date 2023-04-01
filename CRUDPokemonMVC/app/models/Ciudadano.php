<?php

class Ciudadano {
    private $id;
    private $nombre;
    private $password;
    private $direccion;
    private $telefono;

    public function __construct($id, $nombre, $password, $direccion, $telefono)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function __toString() {
        return $this->nombre;
    }
}