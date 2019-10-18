<?php


namespace App\Controller\User;
use App\Service\UserService;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateAction extends AbstractController
{
    /** @var UserService $userService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/user/update/{id}", name="user_update", methods={"PUT"})
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function updateUser(Request $request, $id)
    {

        $content = json_decode($request->getContent(), true);
        $updatedUser = $this->userService->updateUser(
            $this->userService->getUserById($id, Query::HYDRATE_OBJECT),
            $content['email'],
            $content['username'],
            $content['password']
        );
        return new JsonResponse( $updatedUser['username'],Response::HTTP_OK);
    }
}