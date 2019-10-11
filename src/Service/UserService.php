<?php


namespace App\Service;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;


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

    public function new(array $parametersArray) {

        $user = $this->userRepository->insert($parametersArray);

        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
        ];

    }

    public function sitterList()
    {
        $sitters = $this->userRepository->findBy(array('role' => 'sitter'));
        $sitterList = [];
        foreach ($sitters as $sitter) {
            $name = $sitter->getName();
            $username = $sitter->getUsername();
            $district = $sitter->getDistrict();
            array_push($sitterList, $name, $username, $district);
        }

        return $sitterList;
    }

}