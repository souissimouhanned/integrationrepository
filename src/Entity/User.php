<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\ManyToOne(targetEntity=Assureur::class, inversedBy="users")
     */
    private $assureur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.")
     */
    private $email;


  //  private $email;

   


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
    public function getNom(): ?string
    {
        return $this->nom;
    }
/**
 * @param string $nom
 * @return User
 */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
/**
 * @return string
 */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }
/**
 * @param string $prenom
 * @return User
 */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAssureur(): ?Assureur
    {
        return $this->assureur;
    }

    public function setAssureur(?Assureur $assureur): self
    {
        $this->assureur = $assureur;

        return $this;
    }
    public function __toString(){
        return $this->nom;
    }
/**
 * @return string
 */
    public function getEmail(): ?string
    {
        return $this->email;
    }
/**
 * @param string $email
 * @return User
 */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

   
}