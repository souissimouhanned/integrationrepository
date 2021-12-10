<?php

namespace App\Entity;

use App\Repository\AssureurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AssureurRepository::class)
 */
class Assureur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     */
    private $cin_assureur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotEqualTo("00000000")
     * @Assert\NotBlank
     */
    private $num_tel;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="assureur")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
/**
 * @return integer
 */
    public function getId(): ?int
    {
        return $this->id;
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
 * @return Assureur
 */
    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }
/**
 * @return integer
 */
    public function getCinAssureur(): ?int
    {
        return $this->cin_assureur;
    }
/**
 * @param string $cin_assureur
 * @return Assureur
 */
    public function setCinAssureur(int $cin_assureur): self
    {
        $this->cin_assureur = $cin_assureur;

        return $this;
    }
/**
 * @return string
 */
    public function getMail(): ?string
    {
        return $this->mail;
    }
/**
 * @param string $mail
 * @return Assureur
 */
    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }
/**
 * @return integer
 */
    public function getNumTel(): ?int
    {
        return $this->num_tel;
    }
/**
 * @param integer $num_tel
 * @return Assureur
 */
    public function setNumTel(int $num_tel): self
    {
        $this->num_tel = $num_tel;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setAssureur($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAssureur() === $this) {
                $user->setAssureur(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->mail;
}
}