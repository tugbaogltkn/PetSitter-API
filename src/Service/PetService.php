<?php


namespace App\Service;


use App\Entity\Pets;
use App\Repository\PetsRepository;
use Doctrine\ORM\Query;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PetService
{
    /**
     * @var PetsRepository
     */
    private $petRepository;

    public function __construct(PetsRepository $petRepository)
    {
        $this->petRepository = $petRepository;
    }

    public function new(array $parametersArray) {

        $pet = $this->petRepository->insert($parametersArray);

        return [
            'id' => $pet->getId(),
            'type' => $pet->getType(),
            'name' => $pet->getName(),
        ];

    }

    public function petList($id)
    {
        $pets = $this->petRepository->findBy(array('owner' => $id));
        $petList = [];
        foreach ($pets as $pet) {
            $name = $pet->getName();
            $breed = $pet->getBreed();
            $age = $pet->getAge();
            $weight = $pet->getWeight();
            array_push($petList, $name, $breed, $age, $weight);
        }

        return $petList;
    }

    public function deletePet($id)
    {
        $this->petRepository->deletePet($id);
    }

    public function getPetById($id, $hydrate = Query::HYDRATE_ARRAY)
    {
        $pet = $this->petRepository->findPet($id, $hydrate);

        if(!$pet) {
            throw new NotFoundHttpException('pet not found');
        }

        return $pet;
    }

    public function updatePet(
        Pets $pet,
        $name,
        $type,
        $breed,
        $age
    ) {
        $pet->setName($name);
        $pet->setType($type);
        $pet->setBreed($breed);
        $pet->setAge($age);

        $pet = $this->petRepository->update($pet);

        return [
            'id' => $pet->getId(),
            'name' => $pet->getName(),
            'type' => $pet->getType(),
            'breed' => $pet->getBreed(),
            'age' => $pet->getAge(),
        ];
    }

}