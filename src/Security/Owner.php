<?php


namespace App\Security;


class Owner
{
    private $id;
    private $username;
    private $email;
    private $name;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->name = [];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Owner
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Owner
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Owner
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }


    /**
     * @return array
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param array $role
     * @return Owner
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return array
     */
    public function getName(): array
    {
        return $this->name;
    }

    /**
     * @param array $name
     */
    public function setName(array $name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getDistrict(): array
    {
        return $this->district;
    }

    /**
     * @param array $district
     */
    public function setDistrict(array $district)
    {
        $this->district = $district;
    }
}