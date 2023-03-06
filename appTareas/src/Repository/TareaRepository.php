<?php

namespace App\Repository;

use App\Entity\Tarea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

/**
 * @extends ServiceEntityRepository<Tarea>
 *
 * @method Tarea|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarea|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarea[]    findAll()
 * @method Tarea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TareaRepository extends ServiceEntityRepository
{

    private $usuario;

    public function __construct(Security $security, ManagerRegistry $registry)
    {
        parent::__construct($registry, Tarea::class);
        $this->usuario = $security->getUser();
    }

    public function paginacion($dql, $pagina, $elementosPorPagina)
    {
        $paginador = new Paginator($dql);
        $paginador->getQuery()
            ->setFirstResult($elementosPorPagina * ($pagina - 1))
            ->setMaxResults($elementosPorPagina);
        return $paginador;
    }

    public function buscarTodas($pagina = 1, $elementosPorPagina = 5)
    {
        $query = $this->createQueryBuilder('t')
            ->addOrderBy('t.creadoEn', 'ASC')
            ->andWhere('t.usuario = :usuario')
            ->setParameter('usuario', $this->usuario)
            ->getQuery();

        return $this->paginacion($query, $pagina, $elementosPorPagina);
    }

    public function findOneByDescripcion(string $descripcion)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.descripcion = :valorDescripcion')
            ->setParameter('valorDescripcion', $descripcion)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function save(Tarea $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tarea $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function buscarConFiltros($pagina = 1, $elementosPorPagina = 5, string $nombre = null, string $descripcion = null, string $estado = null): Paginator
    {
        $query = $this->createQueryBuilder('t')
            ->addOrderBy('t.creadoEn', 'DESC')
            ->andWhere('t.usuario = :usuario')
            ->setParameter('usuario', $this->usuario)
            ->getQuery();

        if ($nombre) {
            $query = $this->createQueryBuilder('t')
                ->addOrderBy('t.creadoEn', 'DESC')
                ->andWhere('t.usuario = :usuario')
                ->andWhere('t.nombre LIKE :nombre')
                ->setParameter('usuario', $this->usuario)
                ->setParameter('nombre', "%$nombre%")
                ->getQuery();
        }

        if ($descripcion) {
            $query = $this->createQueryBuilder('t')
                ->addOrderBy('t.creadoEn', 'DESC')
                ->andWhere('t.usuario = :usuario')
                ->andWhere('t.descripcion LIKE :descripcion')
                ->setParameter('usuario', $this->usuario)
                ->setParameter('descripcion', "%$descripcion%")
                ->getQuery();
        }

        if ($estado) {
            $query = $this->createQueryBuilder('t')
                ->addOrderBy('t.creadoEn', 'DESC')
                ->andWhere('t.usuario = :usuario')
                ->andWhere('t.estado = :estado')
                ->setParameter('usuario', $this->usuario)
                ->setParameter('estado', $estado)
                ->getQuery();
        }

        if ($nombre && $descripcion) {
            $query = $this->createQueryBuilder('t')
                ->addOrderBy('t.creadoEn', 'DESC')
                ->andWhere('t.usuario = :usuario')
                ->andWhere('t.nombre LIKE :nombre')
                ->andWhere('t.descripcion LIKE :descripcion')
                ->setParameter('usuario', $this->usuario)
                ->setParameter('nombre', "%$nombre%")
                ->setParameter('descripcion', "%$descripcion%")
                ->getQuery();
        }

        if ($nombre && $estado) {
            $query = $this->createQueryBuilder('t')
                ->addOrderBy('t.creadoEn', 'DESC')
                ->andWhere('t.usuario = :usuario')
                ->andWhere('t.nombre LIKE :nombre')
                ->andWhere('t.estado = :estado')
                ->setParameter('usuario', $this->usuario)
                ->setParameter('nombre', "%$nombre%")
                ->setParameter('estado', $estado)
                ->getQuery();
        }

        if ($descripcion && $estado) {
            $query = $this->createQueryBuilder('t')
                ->addOrderBy('t.creadoEn', 'DESC')
                ->andWhere('t.usuario = :usuario')
                ->andWhere('t.descripcion LIKE :descripcion')
                ->andWhere('t.estado = :estado')
                ->setParameter('usuario', $this->usuario)
                ->setParameter('descripcion', "%$descripcion%")
                ->setParameter('estado', $estado)
                ->getQuery();
        }

        return $this->paginacion($query, $pagina, $elementosPorPagina);
    }


}
