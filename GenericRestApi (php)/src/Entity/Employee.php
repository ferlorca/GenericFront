<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class Employee extends Person 
{
    /**
     * @ORM\Column(type="integer")
     */
    private $years;

    /**
     * @ORM\Column(type="integer")
     */
    private $salary;

    /**
     * @ORM\Column(name="work_time",type="integer")
     */
    private $workTime;

    public function __construct()
    {
        parent::__construct();
    }

    public function getYears(): ?int
    {
        return $this->years;
    }

    public function setYears(int $years): self
    {
        $this->years = $years;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getWorkTime(): ?int
    {
        return $this->workTime;
    }

    public function setWorkTime(int $workTime): self
    {
        $this->workTime = $workTime;

        return $this;
    }
}
