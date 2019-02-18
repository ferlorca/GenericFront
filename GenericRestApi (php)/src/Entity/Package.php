<?php
namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ApiResource
 * @ORM\Entity
 */
class Package extends Component
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
     * @var Saving 
     *
     * @ORM\ManyToOne(targetEntity="Saving", inversedBy="products")
     * @Assert\NotBlank
     */
    public $saving;

    /**
     * @var Component[] .
     *
     * @ORM\OneToMany(targetEntity="Component", mappedBy="Package")
     */
    public $components;

    public function __construct()
    {
        parent::__construct();
        $this->components = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setSaving(int $saving): void
	{
		$this->saving = $saving;
	}

	public function getSaving(): Saving
                     	{
                     		return $this->saving;
                         }

    /**
     * @return Collection|Component[]
     */
    public function getComponents(): Collection
    {
        return $this->components;
    }

    public function addComponent(Component $component): self
    {
        if (!$this->components->contains($component)) {
            $this->components[] = $component;
            $component->setPackage($this);
        }

        return $this;
    }

    public function removeComponent(Component $component): self
    {
        if ($this->components->contains($component)) {
            $this->components->removeElement($component);
            // set the owning side to null (unless already changed)
            if ($component->getPackage() === $this) {
                $component->setPackage(null);
            }
        }

        return $this;
    }
    
    
}
