<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DistrictRepository")
 */
class District
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="district")
     */
    private $users;

    /**
     * @ORM\Column()type="text")
     */
    private $postCode;

    /**
     * @ORM\Column()type="text", name="district_name")
     */
    private $districtName;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getPostCode()
    {
        return $this->postCode;
    }
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;
    }
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
    public function getUsers()
    {
        return $this->users;
    }
    public function getDistrictName()
    {
        return $this->districtName;
    }
    public function setDistrictName($districtName)
    {
        return $this->districtName = $districtName;
    }

}
