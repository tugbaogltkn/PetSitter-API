<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PetsRepository")
 */
class Pets
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column()type="text")
     */
    private $type;

    /**
     * @ORM\Column()type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Owner", inversedBy="pets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $owner;

    /**
     * @ORM\Column()type="text")
     */
    private $weight;

    /**
     * @ORM\Column()type="text")
     */
    private $breed;

    /**
     * @ORM\Column()type="integer")
     */
    private $age;

    /**
     * @ORM\Column()type="text")
     */
    private $sex;

    /**
     * @ORM\Column()type="bool")
     */
    private $sterile;

    /**
     * @ORM\Column()type="bool")
     */
    private $microchip;

    /**
     * @ORM\Column()type="bool")
     */
    private $alongWithDogs;

    /**
     * @ORM\Column()type="bool")
     */
    private $alongWithCats;


    /**
     * @ORM\Column()type="bool")
     */
    private $alongWithChildren;

    /**
     * @ORM\Column()type="bool")
     */
    private $houseTrained;

    /**
     * @ORM\Column()type="text")
     */
    private $specialRequirements;

    /**
     * @ORM\Column()type="text")
     */
    private $info;

    /**
     * @ORM\Column()type="text")
     */
    private $aboutPet;

    /**
     * @ORM\Column()type="text")
     */
    private $careInstruction;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        return $this->name = $name;
    }
    public function getOwner()
    {
        return $this->owner;
    }
    public function setOwner($owner)
    {
        return $this->owner = $owner;
    }
    public function getWeight()
    {
        return $this->weight;
    }
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    public function getBreed()
    {
        return $this->breed;
    }
    public function setBreed($breed)
    {
        $this->breed = $breed;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function setAge($age)
    {
        $this->age = $age;
    }
    public function getSex()
    {
        return $this->sex;
    }
    public function setSex($sex)
    {
        $this->sex = $sex;
    }
    public function getSterile()
    {
        return $this->sterile;
    }
    public function setSterile($sterile)
    {
        $this->sterile = $sterile;
    }
    public function getMicrochip()
    {
        return $this->microchip;
    }
    public function setMicrochip($microchip)
    {
        $this->microchip = $microchip;
    }
    public function getAlongWithDogs()
    {
        return $this->alongWithDogs;
    }
    public function setAlongWithDogs($alongWithDogs)
    {
        $this->alongWithDogs = $alongWithDogs;
    }
    public function getAlongWithCats()
    {
        return $this->alongWithCats;
    }
    public function setAlongWithCats($alongWithCats)
    {
        $this->alongWithCats = $alongWithCats;
    }
    public function getAlongWithChildren()
    {
        return $this->alongWithChildren;
    }
    public function setAlongWithChildren($alongWithChildren)
    {
        $this->alongWithChildren = $alongWithChildren;
    }
    public function getHouseTrained()
    {
        return $this->houseTrained;
    }
    public function setHouseTrained($houseTrained)
    {
        $this->houseTrained = $houseTrained;
    }
    public function getSpecialRequirements()
    {
        return $this->specialRequirements;
    }
    public function setSpecialRequirements($specialRequirements)
    {
        $this->specialRequirements = $specialRequirements;
    }
    public function getInfo()
    {
        return $this->info;
    }
    public function setInfo($info)
    {
        $this->info = $info;
    }
    public function getAboutPet()
    {
        return $this->aboutPet;
    }
    public function setAboutPet($aboutPet)
    {
        $this->aboutPet = $aboutPet;
    }
    public function getCareInstruction()
    {
        return $this->careInstruction;
    }
    public function setCareInstruction($careInstruction)
    {
        $this->careInstruction = $careInstruction;
    }
    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this->type = $type;
    }

}
