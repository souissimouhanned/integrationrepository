<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $num_contrat;

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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "Your number must be at least {{ limit }} characters long",
     *      maxMessage = "Your number cannot be longer than {{ limit }} characters"
     * )
     */

    private $num_tel;

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
     * @ORM\Column(type="string", length=255)
     */
    private $destinataire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_contrat;

    /**
     * @ORM\Column(type="date")


     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nature_contart;

    /**
     * @ORM\ManyToOne(targetEntity=Contrat::class, inversedBy="DemandeContratRepository")
     */
    private $contrat;

    /**
     * @ORM\ManyToOne(targetEntity=DemandeContart::class, inversedBy="contrat")
     */
    private $demandeContart;


    public function __construct()
    {
        $this->DemandeContratRepository = new ArrayCollection();
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
    public function getNumContrat(): ?string
    {
        return $this->num_contrat;
    }

    /**
     * @param string $num_contrat
     * @return Contrat
     */
    public function setNumContrat(string $num_contrat): self
    {
        $this->num_contrat = $num_contrat;

        return $this;
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
     * @return Contrat
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
     * @return Contrat
     */
    public function setPrenomUser(string $prenom_user): self
    {
        $this->prenom_user = $prenom_user;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumTel(): ?string
    {
        return $this->num_tel;
    }

    /**
     * @param string $num_tel
     * @return Contrat
     */
    public function setNumTel(string $num_tel): self
    {
        $this->num_tel = $num_tel;

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
     * @return Contrat
     */
    public function setCodePostal(int $code_postal): self
    {
        $this->code_postal = $code_postal;

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
     * @return Contrat
     */
    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestinataire(): ?string
    {
        return $this->destinataire;
    }

    /**
     * @param string $destinataire
     * @return Contrat
     */
    public function setDestinataire(string $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    /**
     * @return string
     */
    public function getTypeContrat(): ?string
    {
        return $this->type_contrat;
    }

    /**
     * @param string $type_contrat
     * @return Contrat
     */
    public function setTypeContrat(string $type_contrat): self
    {
        $this->type_contrat = $type_contrat;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $date
     * @return Contrat
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getNatureContart(): ?string
    {
        return $this->nature_contart;
    }

    /**
     * @param string $nature_contart
     * @return Contrat
     */
    public function setNatureContart(string $nature_contart): self
    {
        $this->nature_contart = $nature_contart;

        return $this;
    }


    public function getContrat(): ?self
    {
        return $this->contrat;
    }

    public function setContrat(?self $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }

    public function getDemandeContart(): ?DemandeContart
    {
        return $this->demandeContart;
    }

    public function setDemandeContart(?DemandeContart $demandeContart): self
    {
        $this->demandeContart = $demandeContart;

        return $this;
    }

    /**
     * @param int $id
     * @return Contrat
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }


    public function __toString()
    {
        return $this->num_contrat;


    }
}
