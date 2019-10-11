<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    public function __construct(ManagerRegistry $registry, EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username')
            ->setParameters([
                    'username' => $username
                ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function insert(array $parametersArray)
    {
        $em = $this->getEntityManager();

        $user = new User();

        $user->setUsername($parametersArray['username']);
        $user->setEmail($parametersArray['email']);
        $user->setName($parametersArray['name']);
        $user->setRole($parametersArray['role']);

        $encoder = $this->encoderFactory->getEncoder($user);
        $password = $encoder->encodePassword($parametersArray['password'], null);

        $user->setPassword($password);

        $em->persist($user);

        $em->flush();

        return $user;
    }


}
