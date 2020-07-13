<?php

namespace App\Entity;

use App\Repository\EtudiantsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantsRepository::class)
 */
class Etudiants
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $nee_at;

    /**
     * @ORM\ManyToOne(targetEntity=Chambres::class, inversedBy="etudiants")
     */
    private $chambre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bourse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
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

    public function getNeeAt(): ?\DateTimeInterface
    {
        return $this->nee_at;
    }

    public function setNeeAt(\DateTimeInterface $nee_at): self
    {
        $this->nee_at = $nee_at;

        return $this;
    }

    public function getChambre(): ?Chambres
    {
        return $this->chambre;
    }

    public function setChambre(?Chambres $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getBourse(): ?int
    {
        return $this->bourse;
    }

    public function setBourse(?int $bourse): self
    {
        $this->bourse = $bourse;

        return $this;
    }

    public function toString()
    {
       return ["nom"=>$this->nom, "prenom"=>$this->prenom, "tel"=>$this->tel, "id"=>$this->id,
       "matricule"=>$this->matricule, "bourse"=>$this->bourse, "adresse"=>$this->adresse,] ;
    }
}
