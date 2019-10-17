<?php


namespace App\EventListener;


use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;

class RequestContentListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        if ($event->isMasterRequest())
        {
            return;
        }

        $request = $event->getRequest();

        if ($request->headers->get('content-type') !== 'application/json')
        {
            throw new UnsupportedMediaTypeHttpException('Unsupported media type requested.',
                null
            );
        }

        if (count($request->request->all())) {
            return;
        }

        $content = $request->getContent();

        if (empty($content)) {
            $content = '{}';
        }

        $data = json_decode($content, true);

        if (is_array($data)) {
            $request->request = new ParameterBag($data);
        } else {
            throw new BadRequestHttpException('Invalid Json data', null);
        }
        
    }
}