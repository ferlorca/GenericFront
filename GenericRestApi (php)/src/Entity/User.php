<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;

/**
* @ORM\Entity(repositoryClass="App\Repository\UserRepository")
* @ApiResource
 */
class User implements UserInterface/*, \Serializable*/
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $roles;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="api_token", type="string",length=1000)
     */
    private $apiToken;


    /**
     * @ORM\OneToOne(targetEntity="Person", inversedBy="user")
     */
    private $person;

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }



	
    
    public function setUsername(string $username): void
	{
		$this->username = $username;
    }
    
    public function getUsername()
    {
        // return $this->username; //se modifico a fines practicos para no renonbrar jwt
        return $this->email;
    }

    
	public function setEmail(string $email): void
               	{
               		$this->email = $email;
               	}

	public function getEmail(): string
               	{
               		return $this->email;
               	}


    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }


	public function setPassword(string $password): void
               	{
               		$this->password = $password;
               	}

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles() 
   {
       $roles[] = $this->roles; 
       if (empty($roles)) {
           $roles[] = 'ROLE_USER'; 
       } 
       return $roles; 
   }

	public function setRoles(string $roles): void
               	{
               		$this->roles = $roles;
               	}

    public function eraseCredentials()
    {
    }

   public function setApiToken($apiToken) 
   { 
       $this->apiToken = $apiToken; 
   }
   
   public function getApiToken() 
   { 
       return $this->apiToken; 
   }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }
}
