<?php

namespace App\DTO;

use ArrayIterator;
use JetBrains\PhpStorm\Pure;

class PaginatedDataDTO
{
    private ArrayIterator $items;
    private int $totalElements;
    private int $offset;
    private int $limit;

    #[Pure] public function __construct()
    {
    }


    public static function of(ArrayIterator $items, int $totalElements, int $offset, int $limit): PaginatedDataDTO
    {
        $page = new PaginatedDataDTO();
        $page->setItems($items)
            ->setTotalElements($totalElements)
            ->setOffset($offset)
            ->setLimit($limit);

        return $page;
    }

    public function setItems(ArrayIterator $items): PaginatedDataDTO
    {
        $this->items = $items;
        return $this;
    }

    public function setTotalElements(int $totalElements): PaginatedDataDTO
    {
        $this->totalElements = $totalElements;
        return $this;
    }


    public function setOffset(int $offset): PaginatedDataDTO
    {
        $this->offset = $offset;
        return $this;
    }


    public function setLimit(int $limit): PaginatedDataDTO
    {
        $this->limit = $limit;
        return $this;
    }



    public function getItems(): ArrayIterator
    {
        return $this->items;
    }


    public function getTotalElements(): int
    {
        return $this->totalElements;
    }


    public function getOffset(): int
    {
        return $this->offset;
    }


    public function getLimit(): int
    {
        return $this->limit;
    }
}
