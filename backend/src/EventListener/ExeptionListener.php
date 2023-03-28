<?php

namespace App\EventListener;

use App\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{

    public function __construct()
    {
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $data = ["errors" => [$exception->getMessage()]];
        $response = new JsonResponse();
        if ($exception instanceof ValidationException) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $errors = $exception->getErrors();
            $data["errors"] = [];
            foreach ($errors as $e) {
                $data["errors"][] = (string) $e->getPropertyPath() . ' not valid, ' . $e->getMessage();
            }
        } else if ($exception->getCode() === 7) {
            $response->setStatusCode(Response::HTTP_CONFLICT);
            $error = explode(':', $exception->getMessage());
            $data = ["errors" => [trim($error['5'])]];
        } else if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response->setData($data);
        $event->setResponse($response);
    }
}
