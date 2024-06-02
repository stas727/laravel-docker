<?php

declare(strict_types=1);

namespace App\Requests\News;

use App\Dto\Request\NewsFindRequestDto;
use App\Dto\Request\IRequestDto;
use App\Requests\GetFilter;
use Illuminate\Foundation\Http\FormRequest;

class FindNewsRequest extends FormRequest implements GetFilter
{
    public function rules(): array
    {
        return [
            'news' => 'exists:App\Models\News,url',
        ];
    }

    public function getFilter(): IRequestDto
    {
        return new NewsFindRequestDto($this->route('news'));
    }
}
