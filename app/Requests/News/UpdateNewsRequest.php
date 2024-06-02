<?php

declare(strict_types=1);

namespace App\Requests\News;

use App\Constants\NewsStatus;
use App\Dto\Request\IRequestDto;
use App\Dto\Request\NewsUpdateRequestDto;
use App\Requests\GetFilter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNewsRequest extends FormRequest implements GetFilter
{
    public function rules(): array
    {
        return [
            'news' => 'exists:App\Models\News,url',
            'status' => [
                'required',
                Rule::in(array_keys(NewsStatus::cases()))
            ],
        ];
    }

    public function getFilter(): IRequestDto
    {
        return new NewsUpdateRequestDto(
            $this->route('news'),
            NewsStatus::from((int)$this->get('status'))
        );
    }
}
