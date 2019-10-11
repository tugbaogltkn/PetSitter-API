<?php


namespace App\Security;


class AccessToken
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->setId();

        $this->user = $user;
    }

    private function setId()
    {
        $this->id = sha1(base64_encode(random_bytes(10)));
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = get_object_vars($this);

        $result['user'] = $this->user->toArray();

        return $result;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}