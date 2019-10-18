<?php


namespace App\Controller\User;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowAction extends AbstractController
{
    /** @var UserService $userService*/
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/user/{id}", name="user_show", methods={"GET"})
     * @param $id
     * @return JsonResponse
     */
    public function userShow($id)
    {
        return new JsonResponse($this->userService->userShow($id),Response::HTTP_OK);
    }

}