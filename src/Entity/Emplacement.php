<?php

namespace App\Entity;

use App\Repository\EmplacementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=EmplacementRepository::class)
 * @UniqueEntity("type_emplacement", message="Cet type est déjà utilisé.")
 */
class Emplacement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    public $id_emplacement;

    /**
     * @ORM\Column(type="string", length=100))
     * @Assert\NotBlank(message = "Type emplacement ne peut pas etre vide")
     * @Groups("post:read")
     */
    public $type_emplacement;

    /**

     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Description ne peut pas etre vide")
     * @Groups("post:read")
     */
    public $Description;

    /**
     * @ORM\OneToMany(targetEntity=Table::class, mappedBy="emp",cascade={"remove"})
     */
    public $tables;

    public function __construct()
    {
        $this->tables = new ArrayCollection();
    }



    public function getIdEmplacement(): ?int
    {
        return $this->id_emplacement;
    }

    public function getTypeEmplacement(): ?string
    {
        return $this->type_emplacement;
    }

    public function setTypeEmplacement(string $type_emplacement): self
    {
        $this->type_emplacement = $type_emplacement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection|Table[]
     */
    public function getTables(): Collection
    {
        return $this->tables;
    }

    public function addTable(Table $table): self
    {
        if (!$this->tables->contains($table)) {
            $this->tables[] = $table;
            $table->setEmp($this);
        }

        return $this;
    }

    /**
     * @param mixed $id_emplacement
     */
    public function setIdEmplacement($id_emplacement): void
    {
        $this -> id_emplacement = $id_emplacement;
    }

    public function removeTable(Table $table): self
    {
        if ($this->tables->removeElement($table)) {
            // set the owning side to null (unless already changed)
            if ($table->getEmp() === $this) {
                $table->setEmp(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return(string)$this->getTypeEmplacement();
    }


}
