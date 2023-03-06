<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public const USUARIO_ADMIN_REFERENCIA = 'user-admin';
    public const USUARIO_USER_REFERENCIA = 'user-user';
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $usuario = new User();
        $usuario->setNombre('admin');
        $usuario->setEmail('admin@admin.com');
        $usuario->setDireccion('adminDireccion');
        $usuario->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $usuario->setActivo(true);
        $usuario->setPassword($this->passwordHasher->hashPassword($usuario, 'admin'));
        $manager->persist($usuario);
        $manager->flush();
        $this->addReference(self::USUARIO_ADMIN_REFERENCIA, $usuario);

        $usuario = new User();
        $usuario->setNombre('user');
        $usuario->setEmail('user@user.com');
        $usuario->setDireccion('userDireccion');
        $usuario->setRoles(['ROLE_USER']);
        $usuario->setActivo(true);
        $usuario->setPassword($this->passwordHasher->hashPassword($usuario, 'user'));
        $manager->persist($usuario);
        $manager->flush();
        $this->addReference(self::USUARIO_USER_REFERENCIA, $usuario);
    }
}
