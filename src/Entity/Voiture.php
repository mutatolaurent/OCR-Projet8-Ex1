<?php

namespace App\Entity;

use App\Enum\BoiteCategories;
use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Length(
        min: 10,
        minMessage: "Le nom doit faire au moins {{ limit }} caractères."
    )]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "La description est obligatoire.")]
    #[Assert\Regex(
        pattern: '/^(\s*\S+\s+){9,}\S+\s*$/',
        message: "La description doit contenir au moins 10 mots."
    )]
    private ?string $description = null;

    #[ORM\Column(type: Types::SMALLFLOAT)]
    #[Assert\NotBlank(message: "Le tarif mensuel est obligatoire.")]
    #[Assert\Positive(message: "Le tarif doit être supérieur à 0.")]
    #[Assert\DivisibleBy(
        value: 0.01,
        message: "Le tarif ne peut pas avoir plus de 2 chiffres après la virgule (ex: 450.50)."
    )]
    private ?float $tarifMois = null;

    #[ORM\Column(type: Types::SMALLFLOAT)]
    #[Assert\NotBlank(message: "Le tarif journalier est obligatoire.")]
    #[Assert\Positive(message: "Le tarif doit être supérieur à 0.")]
    #[Assert\DivisibleBy(
        value: 0.01,
        message: "Le tarif ne peut pas avoir plus de 2 chiffres après la virgule."
    )]
    private ?float $tarifJour = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\Range(min: 1, max: 9)]
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
