<?php


namespace App\Service;

use App\Entity\User;
use App\Security\AccessToken;
use App\Security\User as TokenUser;



class AccessTokenService
{

    private $userService;

    /**
     * Service constructor.
     * @param $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createAccessToken($username, $password = null)
    {
        $user = $this->userService->checkUsernamePassword($username, $password);

        $accessToken = $this->createAccessTokenForUser($user);

        return $accessToken;
    }

    public function createAccessTokenForUser(User $user)
    {
        $tokenUser =new TokenUser();
        $tokenUser
            ->setId($user->getId())
            ->setUsername($user->getUsername())
            ->setEmail($user->getEmail());

        $accessToken = new AccessToken($tokenUser);

        return $accessToken;
    }
}