<?php

namespace App\Entity;

use App\Repository\DemandeContartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DemandeContartRepository::class)
 */
class DemandeContart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull

     */
    private $nom_user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull

     */
    private $prenom_user;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "Your number must be at least {{ limit }} characters long",
     *      maxMessage = "Your number name cannot be longer than {{ limit }} characters"
     * )
     */
    private $num_tel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 4,
     *      max = 10,
     *      minMessage = "Your ville name must be at least {{ limit }} characters long",
     *      maxMessage = "Your ville name cannot be longer than {{ limit }} characters"
     * )
     */
    private $ville;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(
     *      min = 4,
     *      max = 4,
     *      minMessage = "Your code postal must be at least {{ limit }} characters long",
     *      maxMessage = "Your code postal cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotNull
     */
    private $code_postal;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="demandeContart")
     */
    private $contrat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $etat;

    public function __construct()
    {
        $this->contrat = new ArrayCollection();
    }

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
    public function getNomUser(): ?string
    {
        return $this->nom_user;
    }

    /**
     * @param string $nom_user
     * @return DemandeContart
     */
    public function setNomUser(string $nom_user): self
    {
        $this->nom_user = $nom_user;

        return $this;
    }


    /**
     * @return string
     */
    public function getPrenomUser(): ?string
    {
        return $this->prenom_user;
    }

    /**
     * @param string $prenom_user
     * @return DemandeContart
     */
    public function setPrenomUser(string $prenom_user): self
    {
        $this->prenom_user = $prenom_user;

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
     * @param int $num_tel
     * @return DemandeContart
     */
    public function setNumTel(int $num_tel): self
    {
        $this->num_tel = $num_tel;

        return $this;
    }

    /**
     * @return string
     */
    public function getVille(): ?string
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     * @return DemandeContart
     */
    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    /**
     * @param int $code_postal
     * @return DemandeContart
     */
    public function setCodePostal(int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    /**
     * @param int $id
     * @return DemandeContart
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }



    /**
     * @return Collection|Contrat[]
     */
    public function getContrat(): Collection
    {
        return $this->contrat;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrat->contains($contrat)) {
            $this->contrat[] = $contrat;
            $contrat->setDemandeContart($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrat->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getDemandeContart() === $this) {
                $contrat->setDemandeContart(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->prenom_user;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
