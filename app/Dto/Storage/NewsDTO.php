<?php

declare(strict_types=1);

namespace App\Dto\Storage;

use App\Constants\NewsStatus;
use Carbon\Carbon;

class NewsDTO
{
    public function __construct(
        private readonly string     $title,
        private readonly string     $url,
        private readonly string     $shortDescription,
        private readonly string     $fullDescription,
        private readonly Carbon     $createdAt,
        private readonly NewsStatus $status,
    )
    {
    }

    public static function list(array $items): array
    {
        return array_map(function ($item) {
            return (new self(
                $item['title'],
                $item['url'],
                $item['short_description'],
                $item['full_description'],
                $item['created_at'],
                $item['status']
            ))->toArray();
        }, $items);
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'url' => $this->url,
            'short_description' => $this->shortDescription,
            'full_description' => $this->fullDescription,
            'created_at' => $this->createdAt,
            'status' => $this->status,
        ];
    }
}
