<?php

namespace App\ValueResolver;

use App\DTO\PaginateAndFilterDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class GetListValueResolver implements ValueResolverInterface
{

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if ($request->getMethod() != Request::METHOD_GET) return [];
        $limit = $request->query->getInt('limit', 10);
        $offset = $request->query->getInt('offset', 0);
        $filters = [];


        foreach ($request->query->all() as $key => $value) {
            if ($value && $key !== 'limit' && $key !== 'offset') {
                $filters[$key] = $value;
            }
        }
        $data = new PaginateAndFilterDTO($limit, $offset, $filters);
        yield $data;
    }
}
