<?php

declare(strict_types=1);

namespace App\Repository\News;

use App\Dto\Request\NewsFindRequestDto;
use App\Dto\Request\NewsRequestGetDto;
use App\Dto\Request\NewsUpdateRequestDto;
use App\Dto\Storage\NewsDTO;

interface NewsRepository
{
    public function get(NewsRequestGetDto $newsRequestGetDto): array;
    public function find(NewsFindRequestDto $newsFindRequestDto): NewsDTO;
    public function update(NewsUpdateRequestDto $newsUpdateRequestDto): bool;
}
