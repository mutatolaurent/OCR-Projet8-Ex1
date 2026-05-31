<?php

namespace App\Entity;

use App\Enum\BoiteCategories;
use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::SMALLFLOAT)]
    private ?float $tarifMois = null;

    #[ORM\Column(type: Types::SMALLFLOAT)]
    private ?float $tarifJour = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $places = null;

    #[ORM\Column(enumType: BoiteCategories::class)]
    private ?BoiteCategories $boite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTarifMois(): ?float
    {
        return $this->tarifMois;
    }

    public function setTarifMois(float $tarifMois): static
    {
        $this->tarifMois = $tarifMois;

        return $this;
    }

    public function getTarifJour(): ?float
    {
        return $this->tarifJour;
    }

    public function setTarifJour(float $tarifJour): static
    {
        $this->tarifJour = $tarifJour;

        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): static
    {
        $this->places = $places;

        return $this;
    }

    public function getBoite(): ?BoiteCategories
    {
        return $this->boite;
    }

    public function setBoite(BoiteCategories $boite): static
    {
        $this->boite = $boite;

        return $this;
    }
}
