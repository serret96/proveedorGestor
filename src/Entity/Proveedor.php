<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @ORM\Entity(repositoryClass=ProveedorRepository::class)
 */
class Proveedor
{
    use Timestamps;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $correo;

    /**
     * @ORM\Column(type="integer", length=12, unique=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $tipo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activo;


    /**
     * @param $Nombre
     * @param $correo
     * @param $telefono
     * @param $tipo
     * @param $activo
     */
    public function __construct($Nombre = null, $correo = null, $telefono = null, $tipo = null, $activo = null )
    {
        $this->Nombre = $Nombre;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->tipo = $tipo;
        $this->activo = $activo;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

}
