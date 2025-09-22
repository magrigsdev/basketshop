<?php 

namespace App\EventSubscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Exception\TableNotAllowedException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array 
    {
        return [KernelEvents::EXCEPTION => 'onKernelException'];
    }

    public function onKernelException(ExceptionEvent $event )
    {
        $exception = $event->getThrowable();
        if($exception instanceof TableNotAllowedException)
        {
            $response = new JsonResponse([
                'error' =>$exception->getMessage(),
                'code' => 'TABLE_NOT_ALLOWED',
            ], 403); // code http forbidden
            $event->setResponse($response);
        }
    }
}