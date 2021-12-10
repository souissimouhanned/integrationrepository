<?php

namespace App\Entity;

use App\Repository\DetailVoitureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DetailVoitureRepository::class)
 */
class DetailVoiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min = 8,max = 8,minMessage = "Your first name must be at least {{ limit }} characters long",maxMessage = "Your first name cannot be longer than {{ limit }} characters")
     * @Assert\NotBlank
     */
    private $Modele;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Positive
     * @Assert\GreaterThan(1)
     * @Assert\LessThan(8)

     */
    private $NombrePlace;

    /**
     * @ORM\Column(type="float")
     * @Assert\Positive
     */
    private $Valeur;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $puissance;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $age;

    /**
     * @ORM\OneToOne(targetEntity=Voiture::class, inversedBy="detailVoiture", cascade={"persist", "remove"})
     */
    private $relation;
/**
 * @return integer
 */
    public function getId(): ?int
    {
        return $this->id;
    }
/**
 * @return string
 */
    public function getModele(): ?string
    {
        return $this->Modele;
    }
/**
 * @param string $Modele
 * @return DetailVoiture
 */
    public function setModele(string $Modele): self
    {
        $this->Modele = $Modele;

        return $this;
    }
/**
 * @return integer
 */
    public function getNombrePlace(): ?int
    {
        return $this->NombrePlace;
    }
/**
 *@param integer $NombrePlace
 *@return DetailVoiture
 */
    public function setNombrePlace(int $NombrePlace): self
    {
        $this->NombrePlace = $NombrePlace;

        return $this;
    }
/**
 * @return float
 */
    public function getValeur(): ?float
    {
        return $this->Valeur;
    }
/**
 * @param float $Valeur
 * @return DetailVoiture
 */
    public function setValeur(float $Valeur): self
    {
        $this->Valeur = $Valeur;

        return $this;
    }
/**
 * @return integer
 */
    public function getPuissance(): ?int
    {
        return $this->puissance;
    }
/**
 * @param integer $puissance
 * @return DetailVoiture
 */
    public function setPuissance(int $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }
/**
 * @return integer
 */
    public function getAge(): ?int
    {
        return $this->age;
    }
/**
 * @param integer $age
 * @return DetailVoiture
 */
    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }
    /**
     * 
     */
    public function __toString(){
        return $this->Modele;
    }
    public function getRelation(): ?Voiture
    {
        return $this->relation;
    }

    public function setRelation(?Voiture $relation): self
    {
        $this->relation = $relation;

        return $this;
    }
}
