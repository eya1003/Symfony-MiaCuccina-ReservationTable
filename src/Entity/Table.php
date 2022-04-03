<?php

namespace App\Entity;
use App\Repository\TableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TableRepository::class)
 * @ORM\Table(name="`table`")
 */
class Table
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    public $id_tab;
    /*
        /**
         *
         * @ORM\Column(type="integer",name="num_tab", unique=true)
         * @Assert\NotBlank(message = "Num table ne peut pas etre vide")
         * @Assert\Range(
         *      min = 0,
         *      max = 99,
         *      notInRangeMessage = "Il faut choisir entre {{ min }} et {{ max }}",
         * )
         */
    #  private $num_tab;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message = "Nombre des chaises ne peut pas etre vide")
     * @Assert\Range(
     *      min = 2,
     *      max = 6,
     *      notInRangeMessage = "Il faut choisir entre {{ min }} et {{ max }}",
     * )
     * @Groups("post:read")
     */
    public $nb_chaise_tab;


    /**
     * @ORM\ManyToOne(targetEntity=Emplacement::class, inversedBy="tables")
     * @ORM\JoinColumn(name="emp", referencedColumnName="id_emplacement", onDelete="CASCADE")
     * @Groups("post:read")
     */
    public $emp;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message = "Stock des tables ne peut pas etre vide")
     * @Groups("post:read")
     */
    public $stock_tab;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="tab_resv")
     */
    public $reservations;








    public function __construct()
    {
        $this->reservations = new ArrayCollection();

    }




    /**
     * @param mixed $emp
     */
    public function setEmp($emp): void
    {
        $this->emp = $emp;
    }


    public function getIdTab(): ?int
    {
        return $this->id_tab;
    }


    public function getNbChaiseTab(): ?int
    {
        return $this->nb_chaise_tab;
    }

    public function setNbChaiseTab(int $nb_chaise_tab): self
    {
        $this->nb_chaise_tab = $nb_chaise_tab;

        return $this;
    }

    public function getEmp(): ?Emplacement
    {
        return $this->emp;
    }



    public function getStockTab(): ?int
    {
        return $this->stock_tab;
    }

    public function setStockTab(int $stock_tab): self
    {
        $this->stock_tab = $stock_tab;

        return $this;
    }

    public function __toString()
    {
        return(string)$this->getEmp();
    }


    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setTabResv($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getTabResv() === $this) {
                $reservation->setTabResv(null);
            }
        }

        return $this;
    }








}
