<?php


namespace App\Controller\AccessToken;


use App\Service\AccessTokenService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class CreateAction extends AbstractController
{
    /** @var AccessTokenService $accessTokenService */
    private $accessTokenService;

    public function __construct(AccessTokenService $accessTokenService)
    {
        $this->accessTokenService = $accessTokenService;
    }

    /**
     * @Route("/access-token", methods = {"POST"}, name="access_token")
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $item = json_decode($request->getContent(),true);

        return new JsonResponse($this->accessTokenService->createAccessToken($item['username'], $item['password']));
    }

}