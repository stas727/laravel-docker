<?php

declare(strict_types=1);

namespace App\Dto\Request;

use App\Constants\NewsStatus;

class NewsUpdateRequestDto implements IRequestDto
{
    public function __construct(
        private readonly string     $url,
        private readonly NewsStatus $status
    )
    {
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getStatus(): NewsStatus
    {
        return $this->status;
    }
}
