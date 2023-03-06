<?php

namespace App\Repository;

use App\Entity\EstadoTarea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EstadoTarea>
 *
 * @method EstadoTarea|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoTarea|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoTarea[]    findAll()
 * @method EstadoTarea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoTareaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoTarea::class);
    }

    public function save(EstadoTarea $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EstadoTarea $entity, bool $flush = false): void
    {
        // Obtener el ID del estado que se va a eliminar
        $estadoId = $entity->getId();

        // Obtener el estado "undefined"
        $undefinedEstado = $this->createQueryBuilder('e')
            ->where('e.nombre = :nombre')
            ->setParameter('nombre', 'undefined')
            ->getQuery()
            ->getOneOrNullResult();

        // Actualizar las tareas que tienen el estado que se va a eliminar
        $this->getEntityManager()->createQuery('
        UPDATE App\Entity\Tarea t
        SET t.estado = :estadoUndefined
        WHERE t.estado = :estadoEliminar
    ')
            ->setParameter('estadoUndefined', $undefinedEstado)
            ->setParameter('estadoEliminar', $estadoId)
            ->execute();

        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
