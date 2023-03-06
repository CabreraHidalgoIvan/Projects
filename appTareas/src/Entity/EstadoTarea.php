<?php

namespace App\Entity;

use App\Repository\EstadoTareaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstadoTareaRepository::class)]
class EstadoTarea
{
    public const UNDEFINED = 'Undefined';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\OneToMany(mappedBy: 'estado', targetEntity: Tarea::class, cascade: ['persist'])]
    private Collection $tareas;

    public function __construct()
    {
        $this->tareas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Tarea>
     */
    public function getTareas(): Collection
    {
        return $this->tareas;
    }

    public function addTarea(Tarea $tarea): self
    {
        if (!$this->tareas->contains($tarea)) {
            $this->tareas->add($tarea);
            $tarea->setEstado($this);
        }

        return $this;
    }

    public function removeTarea(Tarea $tarea): self
    {
        if ($this->tareas->removeElement($tarea)) {
            // set the owning side to null (unless already changed)
            if ($tarea->getEstado() === $this) {
                $tarea->setEstado(null);
            }
        }

        return $this;
    }

    #[ORM\PreRemove]
    public function actualizarTareas(): void
    {
        $undefinedEstado = $this->entityManager
            ->getRepository(__CLASS__)
            ->findOneBy(['nombre' => self::UNDEFINED]);

        foreach ($this->tareas as $tarea) {
            $tarea->setEstado($undefinedEstado); // O setearlo a un estado "undefined"
        }
    }
}
