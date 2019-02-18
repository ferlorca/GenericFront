<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;



/**
 *  @ORM\MappedSuperclass
 */
class Component
{
    /**
     * @var string 
     *
     * @ORM\Column(type="string")
     */
    public $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text",nullable=true)
     */
    public $description;

    /**
     * @var int 
     *
     * @ORM\Column(type="integer",nullable=true)
     */
    public $discount;

    /**
     * @var Package 
     *
     * @ORM\ManyToOne(targetEntity="Package", inversedBy="components")
     */
    public $package;

     /**
     * @var long 
     *
     * @ORM\Column(type="bigint")
     */
    public $price;

    /**
     * @var int 
     *
     * @ORM\Column(type="integer")
     */
    public $amount;

    /**
     * @var Company 
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="components")
     * @Assert\NotBlank
     */
    public $company;

    /**
     * @var Sale 
     *
     * @ORM\ManyToOne(targetEntity="Sale", inversedBy="products")
     */
    public $sale;

    /**
     * @var Purchase 
     *
     * @ORM\ManyToOne(targetEntity="Purchase", inversedBy="products")
     */
    public $purchase;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
    }

    public function getId()
    {
        return $this->id;
    }


    public function setName($name): void
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
    
    public function setDiscount( $discount): void
	{
		$this->discount = $discount;
	}

	public function getDiscount()
      	{
      		return $this->discount;
          }
    
    public function setPrice( $price): void
	{
		$this->price = $price;
	}

	public function getPrice()
      	{
      		return $this->price;
          }
    

    public function setPackage( $package): void
	{
		$this->package = $package;
	}

	public function getPackage()
      	{
      		return $this->package;
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
}