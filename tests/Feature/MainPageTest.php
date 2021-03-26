<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Tests\TestCase;

class MainPageTest extends TestCase
{
//    use DatabaseTransactions;
//    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * A basic test main page.
     *
     * @return void
     */
    public function test_main_page_posts_in_unpublished_categories()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $this->assertDatabaseMissing('categories', [
            'status' => true,
        ]);
        //new category
        $category = Category::factory()
            ->create(['status' => false]);
        //new post with a category whose status is false
        $post = Post::factory()
            ->create();
        $post->categories()->sync($category->id);

        $this->assertDatabaseHas('categories', [
            'status' => false,
        ]);
        $this->get('/')
            ->assertOk()
            ->assertSee('Блог')
            ->assertDontSee($post->title);
    }

    public function test_main_page_posts_in_published_categories()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $this->assertDatabaseMissing('categories', [
            'status' => true,
        ]);
        //new category
        $category = Category::factory()
            ->create(['status' => true]);
        //new post with a category whose status is true
        $post = Post::factory()
            ->create();
        $post->categories()->sync($category->id);

        $this->assertDatabaseHas('categories', [
            'status' => true,
        ]);
        $this->get('/')
            ->assertOk()
            ->assertSee('Блог')
            ->assertSee($post->title);
    }
}
