<?php


namespace App\Controller\Pet;


use App\Service\PetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateAction extends AbstractController
{
    /** @var PetService $petService */
    private $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    /**
     * @Route("/pet/new", name="pet_user", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function new(Request $request)
    {
        $item = json_decode($request->getContent(),true);

        return new JsonResponse($this->petService->new($item), Response::HTTP_CREATED);
    }


}