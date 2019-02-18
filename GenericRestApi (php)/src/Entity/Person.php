<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;

/**
* @ORM\Entity
* @ORM\InheritanceType("SINGLE_TABLE")
* @ORM\DiscriminatorColumn(name="discr", type="string")
* @ORM\DiscriminatorMap({"person" = "Person", "employee" = "Employee", "client"="Client", "provider"="Provider"})
* @ApiResource
 */
class Person 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $surname;

    /**
     * @ORM\Column(type="date", length=50,nullable=true)
     */
    private $birth;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;


     /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="person")
     */
    private $user;
    

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }


    public function setName(string $name): void
	{
		$this->name = $name;
	}

	public function getName(): string
                     	{
                     		return $this->name;
                     	}

	public function setSurname(string $surname): void
                     	{
                     		$this->surname = $surname;
                     	}

	public function getSurname(): string
                     	{
                     		return $this->surname;
                         }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    public function setBirth(?\DateTimeInterface $birth): self
    {
        $this->birth = $birth;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newPerson = $user === null ? null : $this;
        if ($newPerson !== $user->getPerson()) {
            $user->setPerson($newPerson);
        }

        return $this;
    }
}
