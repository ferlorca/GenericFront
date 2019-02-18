<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class Client extends Person
{
    /**
     * @ORM\Column(name="client_number",type="integer",nullable=true)
     */
    private $clientNumber;

    /**
     * @ORM\Column(name="has_debts",type="boolean")
     */
    private $hasDebts;

    /**
     * @var Sale[] .
     *
     * @ORM\OneToMany(targetEntity="Sale", mappedBy="Client")
     */
    public $purchases;

    public function __construct()
    {
        parent::__construct();
        $this->hasDebts = false;
        $this->purchases = new ArrayCollection();
    }

    public function getClientNumber(): ?int
    {
        return $this->clientNumber;
    }

    public function setClientNumber(int $clientNumber): self
    {
        $this->clientNumber = $clientNumber;

        return $this;
    }

    public function getHasDebts(): ?bool
    {
        return $this->hasDebts;
    }

    public function setHasDebts(bool $hasDebts): self
    {
        $this->hasDebts = $hasDebts;

        return $this;
    }

    /**
     * @return Collection|Sale[]
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Sale $purchase): self
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases[] = $purchase;
            $purchase->setClient($this);
        }

        return $this;
    }

    public function removePurchase(Sale $purchase): self
    {
        if ($this->purchases->contains($purchase)) {
            $this->purchases->removeElement($purchase);
            // set the owning side to null (unless already changed)
            if ($purchase->getClient() === $this) {
                $purchase->setClient(null);
            }
        }

        return $this;
    }
}
