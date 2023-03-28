<?php

namespace App\Util;

use Doctrine\ORM\QueryBuilder;

class Filter
{
    public static function getQueryBuilderWithFilters(QueryBuilder $qb, array $filters = []): QueryBuilder
    {
        foreach ($filters as $key => $value) {
            $qb->andWhere(sprintf('LOWER(entity.%s) LIKE :%s', $key, $key))
                ->setParameter($key, '%' . strtolower($value) . '%');
        }
        return $qb;
    }
}
