<?php

declare(strict_types=1);

namespace Tests\Feature\News;

use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class FindTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->get_url = 'v1/news';
        $this->find_url = 'v1/news/%s';
    }

    #[NoReturn]
    public function test_news_get_success()
    {
        $news = $this->get($this->get_url)
            ->assertSessionHasNoErrors()
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                ['title', 'url', 'short_description', 'full_description', 'created_at', 'status']
            ]);

        $url = json_decode($news->getContent(), true)[0]['url'];

        $this->get(sprintf($this->find_url, $url))
            ->assertSessionHasNoErrors()
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'title', 'url', 'short_description', 'full_description', 'created_at', 'status'
            ]);
    }
}
