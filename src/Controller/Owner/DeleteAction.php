<?php


namespace App\Controller\Owner;

use App\Service\OwnerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeleteAction extends AbstractController
{
    /** @var OwnerService $ownerService */
    private $ownerService;

    public function __construct(OwnerService $ownerService)
    {
        $this->ownerService = $ownerService;
    }

    /**
     * @Route("/owner/delete/{id}", name="owner_delete", methods={"DELETE"})
     * @param $id
     * @return JsonResponse
     */
    public function deleteOwner($id)
    {
        $this->ownerService->deleteOwner($id);

        return new JsonResponse(null,204);
    }

}