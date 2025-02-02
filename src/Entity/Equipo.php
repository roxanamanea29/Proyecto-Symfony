<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity(repositoryClass: EquipoRepository::class)]
class Equipo implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(nullable: true)]
    private ?int $fundacion = null;

    #[ORM\Column(nullable: true)]
    private ?int $socios = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ciudad = null;

    /**
     * @var Collection<int, Jugador>
     */
    #[ORM\OneToMany(targetEntity: Jugador::class, mappedBy: 'equipo')]
    private Collection $jugadores;

    /**
     * @var Collection<int, Instalaciones>
     */
    #[ORM\OneToMany(targetEntity: Instalaciones::class, mappedBy: 'equipo')]
    private Collection $instalaciones;

    public function __construct()
    {
        $this->jugadores = new ArrayCollection();
        $this->instalaciones = new ArrayCollection();
    }
  public function jsonSerialize()
  {
    return [
      'id' => $this->id,
      'nombre' => $this->nombre,
      'fundacion' => $this->fundacion,
      'socios' => $this->socios,
      'ciudad' => $this->ciudad
    ];
  }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFundacion(): ?int
    {
        return $this->fundacion;
    }

    public function setFundacion(?int $fundacion): static
    {
        $this->fundacion = $fundacion;

        return $this;
    }

    public function getSocios(): ?int
    {
        return $this->socios;
    }

    public function setSocios(?int $socios): static
    {
        $this->socios = $socios;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(?string $ciudad): static
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * @return Collection<int, Jugador>
     */
    public function getJugadores(): Collection
    {
        return $this->jugadores;
    }

    public function addJugadore(Jugador $jugadore): static
    {
        if (!$this->jugadores->contains($jugadore)) {
            $this->jugadores->add($jugadore);
            $jugadore->setEquipo($this);
        }

        return $this;
    }

    public function removeJugadore(Jugador $jugadore): static
    {
        if ($this->jugadores->removeElement($jugadore)) {
            // set the owning side to null (unless already changed)
            if ($jugadore->getEquipo() === $this) {
                $jugadore->setEquipo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Instalaciones>
     */
    public function getInstalaciones(): Collection
    {
        return $this->instalaciones;
    }

    public function addInstalacione(Instalaciones $instalacione): static
    {
        if (!$this->instalaciones->contains($instalacione)) {
            $this->instalaciones->add($instalacione);
            $instalacione->setEquipo($this);
        }

        return $this;
    }

    public function removeInstalacione(Instalaciones $instalacione): static
    {
        if ($this->instalaciones->removeElement($instalacione)) {
            // set the owning side to null (unless already changed)
            if ($instalacione->getEquipo() === $this) {
                $instalacione->setEquipo(null);
            }
        }

        return $this;
    }


}
