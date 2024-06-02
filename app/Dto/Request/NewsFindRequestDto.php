<?php

declare(strict_types=1);

namespace App\Dto\Request;

class NewsFindRequestDto implements IRequestDto
{
    public function __construct(private readonly string $url)
    {
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
