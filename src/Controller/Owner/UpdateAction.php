<?php


namespace App\Controller\Owner;

use App\Service\OwnerService;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateAction extends AbstractController
{
    /** var OwnerService $ownerService */
    private $ownerService;

    public function __construct(OwnerService $ownerService)
    {
        $this->ownerService = $ownerService;
    }

    /**
     * @Route("/owner/update/{id}", name="owner_update", methods={"PUT"})
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function updateOwner(Request $request, $id)
    {

        $content = json_decode($request->getContent(), true);
        $updatedOwner = $this->ownerService->updateOwner(
            $this->ownerService->getOwnerById($id, Query::HYDRATE_OBJECT),
            $content['email'],
            $content['username'],
            $content['password'],
            $content['name']
        );
        return new JsonResponse( $updatedOwner['name'],Response::HTTP_OK);
    }
}