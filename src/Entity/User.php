<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @ORM\Column()type="text")
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_verified", type="boolean", options={"default":false, "comment":"Describes user is verified by email"})
     */
    private $isVerified = false;

    /**
     * @ORM\OneToOne(targetEntity="Owner", mappedBy="user", cascade={"persist"})
     */
    private $owner;

    /**
     * @ORM\OneToOne(targetEntity="Sitter", mappedBy="user", cascade={"persist"})
     */
    private $sitter;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('username', new NotBlank());
        $metadata->addPropertyConstraint(
            'username',
            new Assert\Length(["min" => 3])
        );
        $metadata->addPropertyConstraint('email', new Assert\Email([
            'message' => 'The email "{{ value }}" is not a valid email.',
            'checkMX' => true,
        ]));
        $metadata->addPropertyConstraint('password', new Assert\NotBlank());
        $metadata->addPropertyConstraint('password', new Assert\Length([
            'min' => 6,
            'max' => 16
        ]));
        $metadata->addPropertyConstraint('password', new Assert\Regex([
            'pattern' => '#.*^(?=.{6,16})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#',
            'message' => 'Password must include at least 1 uppercase, 1 lowercase, and 1 number'
        ]));
        $metadata->addPropertyConstraint('type', new Assert\NotBlank());
        $metadata->addPropertyConstraint('type', new Assert\NotNull());
        $metadata->addPropertyConstraint('type', new Assert\Choice([
            'choices' => ['sitter', 'owner'],
            'message' => 'Choose a valid type.'
        ]));
        if ('type' == 'sitter') {
            $metadata->addPropertyConstraint('name', new Assert\NotBlank());
            $metadata->addPropertyConstraint('phone', new Assert\NotNull());
            $metadata->addPropertyConstraint('phone', new Assert\NotBlank());
            $metadata->addPropertyConstraint('postCode', new Assert\NotBlank());
            $metadata->addPropertyConstraint('postCode', new Assert\NotNull());
            $metadata->addPropertyConstraint('postCode', new Assert\Range(['01000', '81000']));
        }

        if ('type' == 'owner') {
            $metadata->addPropertyConstraint('name', new Assert\NotBlank());
            $metadata->addPropertyConstraint('phone', new Assert\NotNull());
            $metadata->addPropertyConstraint('phone', new Assert\NotBlank());
            $metadata->addPropertyConstraint('postCode', new Assert\NotBlank());
            $metadata->addPropertyConstraint('postCode', new Assert\NotNull());
            $metadata->addPropertyConstraint('postCode', new Assert\Range(['01000', '81000']));
        }
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setIsVerified($isVerified)
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function isVerified()
    {
        return $this->isVerified;
    }

    public function setOwner(Owner $Owner = null)
    {
        $this->owner = $Owner;

        return $this;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setSitter(Sitter $sitter = null)
    {
        $this->sitter = $sitter;

        return $this;
    }

    public function getSitter()
    {
        return $this->sitter;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
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
