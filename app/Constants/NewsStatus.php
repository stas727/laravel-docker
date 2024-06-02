<?php

declare(strict_types=1);

namespace App\Constants;

enum NewsStatus: int
{
    case ACTIVE = 1;
    case DISABLE = 0;
}
