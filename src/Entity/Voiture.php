<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 */
class Voiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=8)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $CinUtilisateur;

    /**
     * @ORM\Column(type="string", length=11)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 6,
     *      max = 10,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $Matricule;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $Marque;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $CarteGrise;

    /**
     * @ORM\OneToOne(targetEntity=DetailVoiture::class, mappedBy="relation", cascade={"persist", "remove"})
     */
    private $detailVoiture;

    protected $captchaCode;
    /**
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     *@return string 
     */
     
    public function getCinUtilisateur(): ?string
    {
        return $this->CinUtilisateur;
    }
/**
 *@param string $CinUtilisateur
 *@return Voiture
 */
    public function setCinUtilisateur(string $CinUtilisateur): self
    {
        $this->CinUtilisateur = $CinUtilisateur;

        return $this;
    }
/**
 * @return string
 */
    public function getMatricule(): ?string
    {
        return $this->Matricule;
    }
/**
 * @param string $Matricule
 * @return Voiture
 */
    public function setMatricule(string $Matricule): self
    {
        $this->Matricule = $Matricule;

        return $this;
    }
/**
 * @return string
 */
    public function getMarque(): ?string
    {
        return $this->Marque;
    }
/**
 * @param string $Marque
 * @return Voiture
 */
    public function setMarque(string $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }
/**
 * @return string
 */
    public function getCarteGrise(): ?string
    {
        return $this->CarteGrise;
    }
/**
 * @param string $CarteGrise
 * @return Voiture
 */
    public function setCarteGrise(string $CarteGrise): self
    {
        $this->CarteGrise = $CarteGrise;

        return $this;
    }
    public function __toString(){
        return $this->Matricule;
    }
    public function getDetailVoiture(): ?DetailVoiture
    {
        return $this->detailVoiture;
    }
   public function setDetailVoiture(?DetailVoiture $detailVoiture): self
    {
        // unset the owning side of the relation if necessary
        if ($detailVoiture === null && $this->detailVoiture !== null) {
            $this->detailVoiture->setRelation(null);
        }

        // set the owning side of the relation if necessary
        if ($detailVoiture !== null && $detailVoiture->getRelation() !== $this) {
            $detailVoiture->setRelation($this);
        }

        $this->detailVoiture = $detailVoiture;

        return $this;
    }
    public function getCaptchaCode(){
        return $this->captchaCode;
    }
    public function setCaptchaCode ($captchaCode){
        $this->captchaCode=$captchaCode;
    }
}
