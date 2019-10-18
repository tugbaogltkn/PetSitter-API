<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SitterRepository")
 */
class Sitter implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

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
     * @ORM\Column()type="text)
     */
    private $phone;

    /**
     * @ORM\Column()type="text")
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="sitter")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     **/
    private $user;

    /**
     * @ORM\Column()type="text")
     */
    private $address;

    /**
     * @ORM\Column()type="text")
     */
    private $country;

    /**
     * @ORM\Column()type="text")
     */
    private $city;

    /**
     * @ORM\Column()type="text")
     */
    private $state;

    /**
     * @ORM\Column()type="text")
     */
    private $county;

    /**
     * @ORM\Column()type="text")
     */
    private $postCode;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_verified", type="boolean", options={"default":false, "comment":"Describes user is verified by email"})
     */
    private $isVerified = false;

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
    public function getPhone()
    {
        return $this->phone;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPostCode()
    {
        return $this->postCode;
    }
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;
    }
    public function getCity()
    {
        return $this->city;
    }
    public function setCity($city)
    {
        $this->city = $city;
    }
    public function getState()
    {
        return $this->state;
    }
    public function setState($state)
    {
        $this->state = $state;
    }
    public function getCountry()
    {
        return $this->country;
    }
    public function setCountry($country): void
    {
        $this->country = $country;
    }
    public function getCounty()
    {
        return $this->county;
    }
    public function setCounty($county)
    {
        $this->county = $county;
    }
    /**
     * Get isVerified
     *
     * @return boolean
     */
    public function isVerified()
    {
        return $this->isVerified;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
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
        // TODO: Implement getRoles() method.
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
