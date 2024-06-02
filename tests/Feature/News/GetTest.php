<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GetTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->get_url = 'v1/news';
    }

    public function test_news_get_success()
    {
        $this->get($this->get_url)
            ->assertSessionHasNoErrors()
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                ['title', 'url', 'short_description', 'full_description', 'created_at', 'status']
            ]);
    }
}
