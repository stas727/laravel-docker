<?php

declare(strict_types=1);

use App\Constants\NewsStatus;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->get_url = 'v1/news';
        $this->update_url = 'v1/news/%s';
        $this->find_url = 'v1/news/%s';
    }

    public function test_news_activate_success()
    {
        $news = $this->get($this->get_url)
            ->assertSessionHasNoErrors()
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                ['title', 'url', 'short_description', 'full_description', 'created_at', 'status']
            ]);

        $url = json_decode($news->getContent(), true)[0]['url'];

        $this->put(sprintf($this->update_url, $url), [
            'status' => NewsStatus::ACTIVE->value
        ])->assertSessionHasNoErrors()
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(['status' => true]);

        $this->get(sprintf($this->find_url, $url))
            ->assertSessionHasNoErrors()
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'title', 'url', 'short_description', 'full_description', 'created_at', 'status'
            ]);
    }

    public function test_news_deactivate_success()
    {
        $news = $this->get($this->get_url)
            ->assertSessionHasNoErrors()
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                ['title', 'url', 'short_description', 'full_description', 'created_at', 'status']
            ]);

        $url = json_decode($news->getContent(), true)[0]['url'];

        $this->put(sprintf($this->update_url, $url), [
            'status' => NewsStatus::DISABLE->value
        ])->assertSessionHasNoErrors()
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(['status' => true]);

        $this->get(sprintf($this->find_url, $url))
            ->assertSessionHasNoErrors()
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure([
                'status', 'error'
            ]);
    }
}
