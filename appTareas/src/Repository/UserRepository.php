<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function paginacion($dql, $pagina, $elementosPorPagina)
    {
        $paginador = new Paginator($dql);
        $paginador->getQuery()
            ->setFirstResult($elementosPorPagina * ($pagina - 1))
            ->setMaxResults($elementosPorPagina);
        return $paginador;
    }

    public function buscarTodos($pagina = 1, $elementosPorPagina = 5)
    {
        $query = $this->createQueryBuilder('u')
            ->orderBy('u.id', 'ASC')
            ->getQuery();


        return $this->paginacion($query, $pagina, $elementosPorPagina);
    }

    public function buscarConFiltros($pagina = 1, $elementosPorPagina = 5, string $nombre = null, string $email = null, string $roles = null)
    {
        $qb = $this->createQueryBuilder('u')
            ->orderBy('u.id', 'ASC');

        $condiciones = [];
        $parametros = [];

        if ($nombre) {
            $condiciones[] = 'u.nombre LIKE :nombre';
            $parametros['nombre'] = "%$nombre%";
        }

        if ($email) {
            $condiciones[] = 'u.email LIKE :email';
            $parametros['email'] = "%$email%";
        }

        if ($roles) {
            $condiciones[] = 'u.roles LIKE :roles';
            $parametros['roles'] = "%$roles%";
        }

        if (!empty($condiciones)) {
            $qb->andWhere(implode(' AND ', $condiciones))
                ->setParameters($parametros);
        }

        return $this->paginacion($qb, $pagina, $elementosPorPagina);
    }


}
