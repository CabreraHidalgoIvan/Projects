<?php

namespace App\DataFixtures;

use App\Entity\Tarea;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TareaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $tarea = new Tarea();
            $tarea->setNombre('Nombre Tarea - ' . $i);
            $tarea->setDescripcion('Tarea de prueba admin -' . $i);
            $tarea->setUsuario($this->getReference(UserFixtures::USUARIO_ADMIN_REFERENCIA));
            $tarea->setEstado($this->getReference(EstadoFixtures::ESTADO_PENDIENTE_REFERENCIA));
            $manager->persist($tarea);
        }

        for ($i = 0; $i < 20; $i++) {
            $tarea = new Tarea();
            $tarea->setNombre('Nombre Tarea - ' . $i);
            $tarea->setDescripcion('Tarea de prueba user -' . $i);
            $tarea->setUsuario($this->getReference(UserFixtures::USUARIO_USER_REFERENCIA));
            $tarea->setEstado($this->getReference(EstadoFixtures::ESTADO_PENDIENTE_REFERENCIA));
            $manager->persist($tarea);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            EstadoFixtures::class,
        ];
    }
}
