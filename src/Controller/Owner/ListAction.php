<?php


namespace App\Controller\Owner;

use App\Service\OwnerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListAction extends AbstractController
{
    /** @var OwnerService $ownerSevice */
    private $ownerService;

    public function __construct(OwnerService $ownerService)
    {
        $this->ownerService = $ownerService;
    }

    /**
     * @Route("/owner/list", name="owner_list", methods={"GET"})
     * @return JsonResponse
     */
    public function ownerList()
    {
        return new JsonResponse($this->ownerService->ownerList(), Response::HTTP_OK);
    }
}