<?php


namespace App\Controller\Owner;


use App\Service\OwnerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateAction extends AbstractController
{
    /** @var OwnerService $ownerService */
    private $ownerService;

    public function __construct(OwnerService $ownerService)
    {
        $this->ownerService = $ownerService;
    }

    /**
     * @Route("/owner/new", name="new_owner", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function new(Request $request)
    {
        $item = json_decode($request->getContent(),true);

        return new JsonResponse($this->ownerService->new($item), Response::HTTP_CREATED);
    }
}