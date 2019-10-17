<?php


namespace App\Service;

use App\Entity\Owner;
use App\Repository\OwnerRepository;
use Doctrine\ORM\Query;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class OwnerService
{
    /**
     * @var OwnerRepository
     */
    private $ownerRepository;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    public function __construct(OwnerRepository $ownerRepository, EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
        $this->ownerRepository = $ownerRepository;
    }

    public function encodeOwnerPassword(Owner $owner)
    {
        $encoder = $this->encoderFactory->getEncoder($owner);
        $password = $encoder->encodePassword($owner->getPassword(), null);

        return $password;
    }

//    public function checkUsernamePassword($username, $password = null)
//    {
//        $owner = $this->ownerRepository->findOwnerByUsername($username);
//
//        if (!$owner) {
//            throw new NotFoundHttpException('Username is not found or not active');
//        }
//
//        if ($password) {
//            $encoder = $this->encoderFactory->getEncoder($owner);
//
//            $passwordValid = $encoder->isPasswordValid(
//                $owner->getPassword(),
//                $password,
//                null
//            );
//
//            if (!$passwordValid) {
//                throw new NotFoundHttpException('Password is not valid');
//            }
//
//        }
//        return $owner;
//    }

    public function new(array $parametersArray) {

        $owner = $this->ownerRepository->insert($parametersArray);

        return [
            'id' => $owner->getId(),
            'email' => $owner->getEmail(),
        ];

    }

    public function ownerList()
    {
        $owners = $this->ownerRepository->findAll();
        $ownerList = [];
        foreach ($owners as $owner) {
            $name = $owner->getName();
            $username = $owner->getUsername();
            array_push($ownerList, $name, $username);
        }

        return $ownerList;
    }

    public function deleteOwner($id)
    {
        $this->ownerRepository->deleteOwner($id);
    }

    public function getOwnerById($id, $hydrate = Query::HYDRATE_ARRAY)
    {
        $owner = $this->ownerRepository->findOwner($id, $hydrate);

        if (!$owner) {
            throw new NotFoundHttpException('user not found');
        }

        return $owner;
    }

    public function updateOwner(
        Owner $owner,
        $email,
        $username,
        $password = null,
        $name
    ) {
        if ($owner->getEmail() != $email) {
            $owner->setIsVerified(false);
        }

        $owner->setName($name);
        $owner->setEmail($email);
        $owner->setUsername($username);

        if (!empty($password)) {
            $owner
                ->setPassword(
                    $this->encodeOwnerPassword($owner)
                );
        }

        $owner = $this->ownerRepository->update($owner);

        return [
            'id' => $owner->getId(),
            'email' => $owner->getEmail(),
            'name' => $owner->getName(),
            'username' => $owner->getUserName(),
        ];
    }
}