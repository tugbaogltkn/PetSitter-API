<?php


namespace App\Controller\User;


use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeleteAction extends AbstractController
{

    /** @var UserService $userService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/delete/{id}", name="user_delete", methods={"DELETE"})
     * @param $id
     * @return JsonResponse
     */
    public function deleteUser($id)
    {
        $em = $this->getDoctrine()->getManager();

        if(!$id)
        {
            throw $this->createNotFoundException('No user found');
        }

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if($user != null)
        {
            $em->remove($user);
            $em->flush();
        }

        return new JsonResponse(null,204);
    }

}