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
class Company
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
     * @var Saving[] .
     *
     * @ORM\OneToMany(targetEntity="Saving", mappedBy="Company")
     */
    public $saving;


    /**
     * @var Component[] .
     *
     * @ORM\OneToMany(targetEntity="Component", mappedBy="Company")
     */
    public $components;

    /**
     * @var User[] .
     *
     * @ORM\OneToMany(targetEntity="User", mappedBy="Company")
     */
    public $employees;

    /**
     * @var User[] .
     *
     * @ORM\OneToMany(targetEntity="User", mappedBy="Company")
     */
    public $clients;

    /**
     * @var Sale[] .
     * This are budget so the "isBudget" flag need to be true  (make assert)
     * @ORM\OneToMany(targetEntity="Sale", mappedBy="Company")
     */
    public $budgets;

     /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
        $this->saving = new ArrayCollection();
        $this->components = new ArrayCollection();
        $this->budgeds = new ArrayCollection();
        $this->employees = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->budgets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
     * @return Collection|Saving[]
     */
    public function getSaving(): Collection
    {
        return $this->saving;
    }

    public function addSaving(Saving $saving): self
    {
        if (!$this->saving->contains($saving)) {
            $this->saving[] = $saving;
            $saving->setCompany($this);
        }

        return $this;
    }

    public function removeSaving(Saving $saving): self
    {
        if ($this->saving->contains($saving)) {
            $this->saving->removeElement($saving);
            // set the owning side to null (unless already changed)
            if ($saving->getCompany() === $this) {
                $saving->setCompany(null);
            }
        }

        return $this;
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
            $component->setCompany($this);
        }

        return $this;
    }

    public function removeComponent(Component $component): self
    {
        if ($this->components->contains($component)) {
            $this->components->removeElement($component);
            // set the owning side to null (unless already changed)
            if ($component->getCompany() === $this) {
                $component->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(User $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees[] = $employee;
            $employee->setCompany($this);
        }

        return $this;
    }

    public function removeEmployee(User $employee): self
    {
        if ($this->employees->contains($employee)) {
            $this->employees->removeElement($employee);
            // set the owning side to null (unless already changed)
            if ($employee->getCompany() === $this) {
                $employee->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(User $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setCompany($this);
        }

        return $this;
    }

    public function removeClient(User $client): self
    {
        if ($this->clients->contains($client)) {
            $this->clients->removeElement($client);
            // set the owning side to null (unless already changed)
            if ($client->getCompany() === $this) {
                $client->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sale[]
     */
    public function getBudgets(): Collection
    {
        return $this->budgets;
    }

    public function addBudget(Sale $budget): self
    {
        if (!$this->budgets->contains($budget)) {
            $this->budgets[] = $budget;
            $budget->setCompany($this);
        }

        return $this;
    }

    public function removeBudget(Sale $budget): self
    {
        if ($this->budgets->contains($budget)) {
            $this->budgets->removeElement($budget);
            // set the owning side to null (unless already changed)
            if ($budget->getCompany() === $this) {
                $budget->setCompany(null);
            }
        }

        return $this;
    }
}
