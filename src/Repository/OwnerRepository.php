<?php

namespace App\Repository;

use App\Entity\Owner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * @method Owner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Owner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Owner[]    findAll()
 * @method Owner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnerRepository extends ServiceEntityRepository
{

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    public function __construct(ManagerRegistry $registry, EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
        parent::__construct($registry, Owner::class);
    }

    // /**
    //  * @return Owner[] Returns an array of Owner objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Owner
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findOwner($id, $hydrate = Query::HYDRATE_ARRAY)
    {
        return $this->createQueryBuilder('o')
            ->where('o.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult($hydrate);
    }

    public function findOwnerByUsername($username)
    {
        return $this->createQueryBuilder('o')
            ->where('o.username = :username')
            ->setParameters([
                'username' => $username
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function insert(array $parametersArray)
    {
        $em = $this->getEntityManager();

        $owner = new Owner();

        $owner->setName($parametersArray['name']);
        $owner->setUsername($parametersArray['username']);
        $owner->setEmail($parametersArray['email']);
        $owner->setPhone($parametersArray['phone']);
        $owner->setAddress($parametersArray['address']);
        $owner->setCountry($parametersArray['country']);
        $owner->setCity($parametersArray['city']);
        $owner->setState($parametersArray['state']);
        $owner->setCounty($parametersArray['county']);
        $owner->setPostCode($parametersArray['postCode']);


        $encoder = $this->encoderFactory->getEncoder($owner);
        $password = $encoder->encodePassword($parametersArray['password'], null);

        $owner->setPassword($password);

        $em->persist($owner);

        $em->flush();

        return $owner;
    }

    public function deleteOwner($id)
    {
        $em = $this->getEntityManager();

        if(!$id)
        {
            throw new NotFoundHttpException('You must enter id');
        }

        $owner = $this->find($id);

        if(!$owner)
        {
            throw new NotFoundHttpException('No owner found with this id');
        }

        if($owner != null)
        {
            $em->remove($owner);
            $em->flush();
        }
    }

    public function update($updatedOwner)
    {
        $em = $this->getEntityManager();

        $em->persist($updatedOwner);

        $em->flush();

        return $updatedOwner;
    }

}
