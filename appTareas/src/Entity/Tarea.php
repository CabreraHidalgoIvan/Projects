<?php

namespace App\Entity;

use App\Repository\TareaRepository;
use App\Validator as AppAssert;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[AppAssert\TareaUnica]
#[ORM\Entity(repositoryClass: TareaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Tarea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Es necesario que introduzcas una descripción.')]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creadoEn = null;

    #[ORM\ManyToOne(inversedBy: 'tareas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $usuario = null;

    #[ORM\ManyToOne(targetEntity: EstadoTarea::class, inversedBy: 'tareas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EstadoTarea $estado = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    public function getId(): ?int
    {
        return $this->id;
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


    public function getCreadoEn(): ?\DateTimeInterface
    {
        return $this->creadoEn;
    }

    #[ORM\PrePersist]
    public function setValorCreadoEn(): self
    {
        $this->creadoEn = new \DateTime();

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getEstado(): ?EstadoTarea
    {
        return $this->estado;
    }

    public function setEstado(?EstadoTarea $estado): self
    {
        $this->estado = $estado;

        return $this;
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


}
