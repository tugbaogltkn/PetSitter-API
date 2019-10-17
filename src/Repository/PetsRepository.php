<?php

namespace App\Repository;

use App\Entity\Pets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method Pets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pets[]    findAll()
 * @method Pets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pets::class);
    }

    // /**
    //  * @return Pets[] Returns an array of Pets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pets
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findPet($id, $hydrate = Query::HYDRATE_ARRAY)
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult($hydrate);

    }

    public function insert(array $parametersArray)
    {
        $em = $this->getEntityManager();

        $pet = new Pets();

        $pet->setType($parametersArray['type']);
        $pet->setName($parametersArray['name']);
        $pet->setOwner($parametersArray['owner']);
        $pet->setWeight($parametersArray['weight']);
        $pet->setWeight($parametersArray['weight']);
        $pet->setBreed($parametersArray['breed']);
        $pet->setAge($parametersArray['age']);
        $pet->setSex($parametersArray['sex']);
        $pet->setSterile($parametersArray['sterile']);
        $pet->setMicrochip($parametersArray['microchip']);
        $pet->setAlongWithDogs($parametersArray['alongWithDogs']);
        $pet->setAlongWithCats($parametersArray['alongWithCats']);
        $pet->setAlongWithChildren($parametersArray['alongWithChildren']);
        $pet->setHousetrained($parametersArray['houseTrained']);
        $pet->setSpecialRequirements($parametersArray['specialRequirements']);
        $pet->setInfo($parametersArray['info']);
        $pet->setAboutPet($parametersArray['aboutPet']);
        $pet->setCareInstruction($parametersArray['careInstruction']);

        $em->persist($pet);

        $em->flush();

        return $pet;
    }

    public function deletePet($id)
    {
        $em = $this->getEntityManager();

        if(!$id)
        {
            throw new NotFoundHttpException('You must enter id');
        }

        $pet = $this->find($id);

        if(!$pet)
        {
            throw new NotFoundHttpException('No pet found with this id');
        }

        if($pet != null)
        {
            $em->remove($pet);
            $em->flush();
        }
    }

    public function update($updatedPet)
    {
        $em = $this->getEntityManager();

        $em->persist($updatedPet);

        $em->flush();

        return $updatedPet;
    }
}
