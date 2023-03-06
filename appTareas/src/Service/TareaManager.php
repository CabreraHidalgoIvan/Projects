<?php

namespace App\Service;

use App\Entity\Tarea;
use App\Repository\TareaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TareaManager {

    private $em;
    private $tareaRepository;
    private $validator;

    public function __construct(EntityManagerInterface $em, TareaRepository $tareaRepository, ValidatorInterface $validator)
    {
        $this->em = $em;
        $this->tareaRepository = $tareaRepository;
        $this->validator = $validator;
    }

    public function crearTarea(Tarea $tarea)
    {
        $this->em->persist($tarea);
        $this->em->flush();
    }

    public function editarTarea(Tarea $tarea)
    {
        $this->em->flush();
    }

    public function eliminarTarea(Tarea $tarea)
    {
        $this->em->remove($tarea);
        $this->em->flush();
    }

    public function validar(Tarea $tarea)
    {

        return $this->validator->validate($tarea);

    }
}