<?php

namespace App\DTO;


class PaginateAndFilterDTO
{
    private ?array $filters;
    private ?int $offset;
    private ?int $limit;

    public function __construct(?int $limit, ?int $offset, ?array $filters)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->filters = $filters;
    }


    public function getFilters(): ?array
    {
        return $this->filters;
    }

    public function setFilters(array $filters): self
    {
        $this->filters = $filters;
        return $this;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }
}
