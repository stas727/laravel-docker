<?php

declare(strict_types=1);

namespace App\Repository\News;

use App\Dto\Request\NewsFindRequestDto;
use App\Dto\Request\NewsRequestGetDto;
use App\Dto\Request\NewsUpdateRequestDto;
use App\Dto\Storage\NewsDTO;
use App\Models\News;
use Illuminate\Database\Eloquent\Builder;

class DBNewsRepository implements NewsRepository
{
    public function __construct(private readonly News $news)
    {
    }

    public function get(NewsRequestGetDto $newsRequestGetDto): array
    {
        $query = $this->news->newQuery();

        $news = $query
            ->active()
            ->select(
                'title',
                'url',
                'short_description',
                'created_at',
                'status'
            )
            ->when(
                $newsRequestGetDto->getTitle(),
                function (Builder $builder) use ($newsRequestGetDto) {
                    $builder->where('title', 'like', "%{$newsRequestGetDto->getTitle()}%");
                }
            )
            ->simplePaginate($newsRequestGetDto->getLimit(), '*', 'offset', $newsRequestGetDto->getOffset())
            ->items();

        return NewsDTO::list($news);
    }

    public function find(NewsFindRequestDto $newsFindRequestDto): NewsDTO
    {
        /** @var News $news */
        $news = $this->news
            ->newQuery()
            ->where('url', $newsFindRequestDto->getUrl())
            ->active()
            ->firstOrFail();

        return (new NewsDTO(
            title: $news->title,
            url: $news->url,
            shortDescription: $news->short_description,
            fullDescription: $news->full_description,
            createdAt: $news->created_at,
            status: $news->status
        ));
    }

    public function update(NewsUpdateRequestDto $newsUpdateRequestDto): bool
    {
        $news = $this->news
            ->newQuery()
            ->where('url', $newsUpdateRequestDto->getUrl())
            ->firstOrFail();

        return $news->updateOrFail([
            'status' => $newsUpdateRequestDto->getStatus(),
        ]);
    }
}
