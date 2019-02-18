<?php
namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity
* @ApiResource
 */
class Sale
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text",nullable=true)
     */
    public $description;

    /**
     * @var Product[]
     *
     * @ORM\OneToMany(targetEntity="Component", mappedBy="Sale")
     */
    public $products;

    /**
     * @var Company 
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="components")
     * @Assert\NotBlank
     */
    public $company;

    /**
     * @var Saving 
     *
     * @ORM\ManyToOne(targetEntity="Saving", inversedBy="sales")
     * @Assert\NotBlank
     */
    public $saving;

    /**
     * @var Client 
     *
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="purchases")
     * @Assert\NotBlank
     */
    public $client;

    /**
     * @var int 
     *
     * @ORM\Column(type="integer",nullable=true)
     */
    public $discount;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="is_budget", type="boolean")
     */
    private $isBudget;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(?int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsBudget(): ?bool
    {
        return $this->isBudget;
    }

    public function setIsBudget(bool $isBudget): self
    {
        $this->isBudget = $isBudget;

        return $this;
    }

    /**
     * @return Collection|Component[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Component $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setSale($this);
        }

        return $this;
    }

    public function removeProduct(Component $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getSale() === $this) {
                $product->setSale(null);
            }
        }

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getSaving(): ?Saving
    {
        return $this->saving;
    }

    public function setSaving(?Saving $saving): self
    {
        $this->saving = $saving;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
