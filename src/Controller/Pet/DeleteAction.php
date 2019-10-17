<?php


namespace App\Controller\Pet;


use App\Service\PetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeleteAction extends AbstractController
{
    /** @var PetService $petService */
    private $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    /**
     * @Route("/pet/delete/{id}", name="pet_delete", methods={"DELETE"})
     * @param $id
     * @return JsonResponse
     */
    public function deletePet($id)
    {
        $this->petService->deletePet($id);

        return new JsonResponse(null, 204);
    }

}