<?php

namespace App\ValueResolver;

use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

final class BodyValueResolver implements ValueResolverInterface
{
    private SerializerInterface $serializer;
    public function __construct()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
    }


    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $method = $request->getMethod();
        if (
            $method != Request::METHOD_POST
            && $method != Request::METHOD_PUT
            && $method != Request::METHOD_PATCH
        ) {
            return [];
        }
        $type = $argument->getType();
        $format = $request->getContentTypeFormat() ?? 'json';
        $content = $request->getContent();

        $data = $this->serializer->deserialize($content, $type, $format);

        yield $data;
    }
}
