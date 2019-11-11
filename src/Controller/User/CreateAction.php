<?php


namespace App\Controller\User;


use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateAction extends AbstractController
{
    /** @var UserService $userService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/user", name="new_user", methods={"POST"})
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return Response
     */
    public function new(Request $request, ValidatorInterface $validator)
    {
        $item = json_decode($request->getContent(),true);

        $user = new User();

        $user->setUsername($item['username']);
        $user->setEmail($item['email']);
        $user->setType($item['type']);
        $user->setPassword($item['password']);

        $errors = $validator->validate($user);

        if (count($errors) > 0) {

            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        return new JsonResponse($this->userService->newUser($user), Response::HTTP_CREATED);
    }
}