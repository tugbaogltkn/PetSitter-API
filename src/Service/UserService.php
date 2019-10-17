<?php


namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    public function __construct(UserRepository $userRepository, EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
        $this->userRepository = $userRepository;
    }

    public function encodeUserPassword(User $user)
    {
        $encoder = $this->encoderFactory->getEncoder($user);
        $password = $encoder->encodePassword($user->getPassword(), null);

        return $password;
    }

    public function checkUsernamePassword($username, $password = null)
    {
        $user = $this->userRepository->findUserByUsername($username);

        if (!$user) {
            throw new NotFoundHttpException('Username is not found or not active');
        }

        if ($password) {
            $encoder = $this->encoderFactory->getEncoder($user);

            $passwordValid = $encoder->isPasswordValid(
                $user->getPassword(),
                $password,
                null
            );

            if (!$passwordValid) {
                throw new NotFoundHttpException('Password is not valid');
            }

        }
        return $user;
    }
}