<?php

declare(strict_types=1);

namespace App\Requests\News;

use App\Dto\Request\NewsRequestGetDto;
use App\Requests\GetFilter;
use Illuminate\Foundation\Http\FormRequest;

class GetNewsRequest extends FormRequest implements GetFilter
{
    const DEFAULT_LIMIT = 10;
    const DEFAULT_OFFSET = 0;

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'limit' => ['nullable', 'int', 'min:1', 'max:100'],
            'offset' => ['nullable', 'int', 'min:1'],
        ];
    }

    public function getFilter(): NewsRequestGetDto
    {
        return new NewsRequestGetDto(
            (int)$this->get('limit', self::DEFAULT_LIMIT),
            (int)$this->get('offset', self::DEFAULT_OFFSET),
            (string)$this->get('title')
        );
    }
}
