<?php
namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity
 */
class Saving
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
     * @ORM\Column
     */
    public $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text",nullable=true)
     */
    public $description;

    /**
     * @var Product[]
     *
     * @ORM\OneToMany(targetEntity="Product", mappedBy="Saving")
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
     * @var Sale[] .
     * This aren't a budget so the "isBudget" flag need to be false  (make assert)
     * @ORM\OneToMany(targetEntity="Sale", mappedBy="Company")
     */
    public $sales;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }


    public function setName( $name): void
	{
		$this->name = $name;
	}

	public function getName()
                           	{
                           		return $this->name;
                               }
    
    public function setDescription( $description): void
	{
		$this->description = $description;
	}

	public function getDescription()
                           	{
                           		return $this->description;
                               }

    public function setCompany( $company): void
	{
		$this->company = $company;
	}

	public function getCompany()
                           	{
                           		return $this->company;
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

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setSaving($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getSaving() === $this) {
                $product->setSaving(null);
            }
        }

        return $this;
    }
}
