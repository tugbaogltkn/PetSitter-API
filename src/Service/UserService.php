<?php


namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\Query;
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

    public function newUser(array $parametersArray) {

        $user = $this->userRepository->insert($parametersArray);

        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
        ];

    }

    public function userList()
    {
        $users = $this->userRepository->findAll();
        $userList = [];
        foreach ($users as $user) {
            $username = $user->getUsername();
            $type = $user->getType();
            array_push($userList, $username, $type);
        }

        return $userList;
    }

    public function userShow($id)
    {
        $user = $this->userRepository->find($id);

        $username = $user->getUsername();
        $type = $user->getType();

        return [
            'username' => $username,
            'type' => $type
        ];
    }

    public function deleteUser($id)
    {
        $this->userRepository->deleteUser($id);
    }

    public function getUserById($id, $hydrate = Query::HYDRATE_ARRAY)
    {
        $user = $this->userRepository->findUser($id, $hydrate);

        if (!$user) {
            throw new NotFoundHttpException('user not found');
        }

        return $user;
    }

    public function updateUser(
        User $user,
        $email,
        $username,
        $password = null
    ) {
       if ($user->getEmail() != $email) {
           $user->setIsVerified(false);
       }

       $user->setEmail($email);
       $user->setUsername($username);

       if (!empty($password)) {
           $user
               ->setPassword(
                   $this->encodeUserPassword($user)
               );
       }

       $user = $this->userRepository->update($user);

       return [
           'id' => $user->getId(),
           'email' => $user->getEmail(),
           'username' => $user->getUsername(),
       ];
    }
}