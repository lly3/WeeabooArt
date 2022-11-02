<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase; // important to call library of laravel

class PostTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    protected function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function test_new_post_have_default_values()
    {
        $post = new Post();
        $post->title = "test title";
        $post->description = "test description";
        $post->image_id = 1;
        $post->user_id = 1;
        $post->save();

        $this->assertEquals(0, $post->favorite_count);
        $this->assertEquals(0, $post->view_count);
        $this->assertEquals(false, $post->is_saleable);
    }
}
