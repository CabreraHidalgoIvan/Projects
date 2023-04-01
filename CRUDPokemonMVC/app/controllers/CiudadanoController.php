<?php

require_once "../models/Ciudadano.php";
require_once "../models/CiudadanoDAO.php";

class CiudadanoController
{
    private $ciudadanoDAO;

    public function __construct()
    {
        $this->ciudadanoDAO = new CiudadanoDAO();
    }

    public function getAll()
    {
        $ciudadanos = $this->ciudadanoDAO->getAll();
        // Enviar $ciudadanos a la vista correspondiente para mostrarlos
    }

    public function getById($id)
    {
        $ciudadano = $this->ciudadanoDAO->getById($id);
        // Enviar $ciudadano a la vista correspondiente para mostrarlo
    }

    public function getByAnyField($data)
    {
        $ciudadanos = $this->ciudadanoDAO->getByAnyField($data);
        // Enviar $ciudadanos a la vista correspondiente para mostrarlos
    }

    public function getByName($name)
    {
        $ciudadanos = $this->ciudadanoDAO->getByName($name);
        // Enviar $ciudadanos a la vista correspondiente para mostrarlos
    }

    public function create($data)
    {
        $this->ciudadanoDAO->set($data);
        // Redirigir a la vista correspondiente
    }

    public function edit($data)
    {
        $this->ciudadanoDAO->edit($data);
        // Redirigir a la vista correspondiente
    }

    public function editEs_entrenador($data)
    {
        $this->ciudadanoDAO->editEs_entrenador($data);
        // Redirigir a la vista correspondiente
    }

    public function delete($id)
    {
        $this->ciudadanoDAO->delete($id);
        // Redirigir a la vista correspondiente
    }
}
