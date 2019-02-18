<?php
namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ApiResource
 * @ORM\Entity
 */
class Product extends Component
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
     * @var Saving The book this review is about.
     *
     * @ORM\ManyToOne(targetEntity="Saving", inversedBy="products")
     * @Assert\NotBlank
     */
    public $saving;

      /**
     * @var long 
     *
     * @ORM\Column(name="price_cost",type="bigint")
     */
    public $priceCost;

    public function getId()
    {
        return $this->id;
    }

    public function setSaving( $saving): void
	{
		$this->saving = $saving;
	}

	public function getSaving(): Saving
      	{
      		return $this->saving;
      	}

    public function getPriceCost(): ?int
    {
        return $this->priceCost;
    }

    public function setPriceCost(int $priceCost): self
    {
        $this->priceCost = $priceCost;

        return $this;
    }
}
