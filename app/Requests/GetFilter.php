<?php

declare(strict_types=1);

namespace App\Requests;

use App\Dto\Request\IRequestDto;

interface GetFilter
{
    public function getFilter(): IRequestDto;
}
