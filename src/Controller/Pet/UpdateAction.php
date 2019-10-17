<?php


namespace App\Controller\Pet;


use App\Service\PetService;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateAction extends AbstractController
{
    /** @var PetService $petService */
    private $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    /**
     * @Route("/pet/update/{id}", name="pet_update", methods={"PUT"})
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function updatePet(Request $request, $id)
    {
        $content = json_decode($request->getContent(), true);
        $updatedPet = $this->petService->updatePet(
            $this->petService->getPetById($id, Query::HYDRATE_OBJECT),
            $content['name'],
            $content['type'],
            $content['breed'],
            $content['age']
        );

        return new JsonResponse($updatedPet['name'],Response::HTTP_OK);
    }
}