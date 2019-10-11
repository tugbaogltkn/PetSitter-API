<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Pets", mappedBy="user")
     */
    private $pets;

    /**
     * @ORM\Column()type="text")
     */
    private $role;

    /**
     * @ORM\Column()type="text")
     */
    private $name;

    /**
     * @ORM\Column()type="text", name="user_name")
     */
    private $username;

    /**
     * @ORM\Column()type="text)
     */
    private $email;

    /**
     * @ORM\Column()type="text")
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity="District", inversedBy="user")
     * @ORM\JoinColumn(name="district_id", referencedColumnName="id", nullable=false)
     */
    private $district;

    public function getId()
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
    public function __construct()
    {
        $this->pets = new ArrayCollection();
    }
    public function getPets()
    {
        return $this->pets;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        return $this->username = $username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        return $this->email = $email;
    }
    public function getDistrict()
    {
        return $this->district;
    }
    public function setDistrict($district)
    {
        $this->district = $district;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }


    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string|null The encoded password if any
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
