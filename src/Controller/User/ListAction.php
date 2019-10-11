<?php


namespace App\Controller\User;


use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class ListAction extends AbstractController
{
    /** @var UserService $userService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/sitter/list", name="product_list", methods={"GET"})
     * @return JsonResponse
     */
    public function sitterList()
    {
        return new JsonResponse($this->userService->sitterList());
    }

}