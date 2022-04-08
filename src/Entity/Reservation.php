<?php

namespace App\Entity;

use App\Repository\ReservationRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    public $id_resv;


    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message = " ne peut pas etre vide")
     * @Assert\Length(min = 8, max = 20, minMessage = "min_lenght", maxMessage = "max_lenght")
     * @Assert\Regex(pattern="/^[0-9]*$/", message ="number_only")
     * @Groups("post:read")
     */
    public $phone_resv;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message = " ne peut pas etre vide")
     * @Groups("post:read")
     */
    public $Email_resv;
    /*
        /**
         * @ORM\ManyToOne(targetEntity=Table::class, inversedBy="reservations")
         * @ORM\JoinColumn(name="numTab_resv", referencedColumnName="id_tab", onDelete="CASCADE")
         */
    #private $numTab_resv;



    /**
     * @ORM\Column(type="datetime")
     * @Groups("post:read")
     */
    public $date_resv;

    /**
     * @ORM\ManyToOne(targetEntity=Table::class, inversedBy="reservations")
     * @ORM\JoinColumn(name="tab_resv", referencedColumnName="id_tab", onDelete="CASCADE")
     */
    public $tab_resv;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("post:read")
     */
    public $end_resv;





    public function __construct()
    {
        $this->stock_resv = new ArrayCollection();
    }



    /*
      * @ORM\Column(type="integer", nullable=true,options={"default":0}))
      */
    //  private $stock_resv;






    /* public function __construct()
     {
         $this->perso_resv = new ArrayCollection();
     }*/




    public function getIdResv(): ?int
    {
        return $this->id_resv;
    }



    public function getPhoneResv(): ?int
    {
        return $this->phone_resv;
    }

    public function setPhoneResv(int $phone_resv): self
    {
        $this->phone_resv = $phone_resv;

        return $this;
    }

    public function getEmailResv(): ?string
    {
        return $this->Email_resv;
    }

    public function setEmailResv(string $Email_resv): self
    {
        $this->Email_resv = $Email_resv;

        return $this;
    }




    public function getDateResv(): ?\DateTimeInterface
    {
        return $this->date_resv;
    }

    public function setDateResv(\DateTimeInterface $date_resv): self
    {
        $this->date_resv = $date_resv;

        return $this;
    }

    public function __toString()
    {
        return(string)$this->getTabResv();
    }

    public function getTabResv(): ?String
    {
        return(string)$this->tab_resv;

    }

    public function setTabResv(?Table $tab_resv): self
    {
        $this->tab_resv = $tab_resv;

        return $this;
    }
    /*
        public function getStockResv(): ?int
        {
            return $this->stock_resv;
        }

        public function setStockResv(?int $stock_resv): self
        {
            $this->stock_resv = $stock_resv;

            return $this;
        }
    */

    public function getEndResv(): ?\DateTimeInterface
    {
        return $this->end_resv;
    }

    public function setEndResv(\DateTimeInterface $end_resv): self
    {
        $this->end_resv = $end_resv;

        return $this;
    }








}
