<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class Provider extends Person
{
    /**
     * @ORM\Column(name="provider_number",type="integer")
     */
    private $providerNumber;

    /**
     * @var Sale[] .
     *
     * @ORM\OneToMany(targetEntity="Purchase", mappedBy="Provider")
     */
    public $sales;

    public function __construct()
    {
        parent::__construct();
    }
}
