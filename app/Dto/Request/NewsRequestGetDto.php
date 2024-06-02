<?php

declare(strict_types=1);

namespace App\Dto\Request;

class NewsRequestGetDto implements IRequestDto
{
    public function __construct(
        private readonly int    $limit,
        private readonly int    $offset,
        private readonly ?string $title
    )
    {
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
