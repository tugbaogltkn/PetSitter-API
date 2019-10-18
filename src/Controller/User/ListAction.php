<?php


namespace App\Controller\User;

use App\Service\UserService;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/user/list", name="user_list", methods={"GET"})
     * @return JsonResponse
     */
    public function userList()
    {
        return new JsonResponse($this->userService->userList(), Response::HTTP_OK);
    }
}