<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    /** ValidatorInterface $validator */
    private $validator;

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

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findUser($id, $hydrate = Query::HYDRATE_ARRAY)
    {
        return $this->createQueryBuilder('u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult($hydrate);
    }

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

    public function insert(User $user)
    {
        $em = $this->getEntityManager();

        $encoder = $this->encoderFactory->getEncoder($user);
        $password = $encoder->encodePassword($user->getPassword(), null);

        $user->setPassword($password);

        $em->persist($user);

        $em->flush();

        return $user;
    }

    public function deleteUser($id)
    {
        $em = $this->getEntityManager();

        if(!$id)
        {
            throw new NotFoundHttpException('You must enter id');
        }

        $user = $this->find($id);

        if(!$user)
        {
            throw new NotFoundHttpException('No owner found with this id');
        }

        if($user != null)
        {
            $em->remove($user);
            $em->flush();
        }
    }

    public function update($updatedUser)
    {
        $em = $this->getEntityManager();

        $em->persist($updatedUser);

        $em->flush();

        return $updatedUser;
    }
}
