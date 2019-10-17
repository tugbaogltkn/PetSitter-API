<?php


namespace App\Controller\Pet;


use App\Service\PetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListAction extends AbstractController
{
    /** @var PetService $petService */
    private $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    /**
     * @Route("/pet/list/{id}", name="pet_list", methods={"GET"})
     * @param $id
     * @return JsonResponse
     */
    public function petList($id)
    {
        return new JsonResponse($this->petService->petList($id));
    }

}