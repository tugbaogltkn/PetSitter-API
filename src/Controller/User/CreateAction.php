<?php


namespace App\Controller\User;

use App\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CreateAction extends AbstractController
{
    /** @var UserService $userService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/user/new", name="new_user", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function new(Request $request)
    {
        $item = json_decode($request->getContent(),true);

        return new JsonResponse($this->userService->new($item), Response::HTTP_CREATED);
    }
}