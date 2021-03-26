<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
    }

    public function testIndex()
    {
        $this->actingAsAdmin()
            ->get("/admin/posts")
            ->assertOk()
            ->assertSee('Статьи')
            ->assertSee('Заголовок');
    }

    public function testCreate()
    {
        $this->actingAsAdmin()
            ->get('/admin/posts/create')
            ->assertOk()
            ->assertSee('Создание')
            ->assertSee('Заголовок')
            ->assertSee('Изображение')
            ->assertSee('Категории')
            ->assertSee('Контент')
            ->assertSee('Сохранить');
    }

    public function testStore()
    {
        $params = $this->validParams();

        $this->actingAsAdmin()
            ->post('/admin/posts', $params)
            ->assertStatus(302);

        $this->assertDatabaseHas('posts', $params);
    }

    public function testStoreFail()
    {
        $params = $this->validParams(['content' => null]);

        $this->actingAsAdmin()
            ->post('/admin/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    public function testEdit()
    {
        $post = Post::first();

        $response = $this->actingAsAdmin()->get(route('admin.posts.edit', $post));
        $response
            ->assertOk()
            ->assertSee('Редактирование')
            ->assertSee('Заголовок')
            ->assertSee('Slug')
            ->assertSee('Изображение')
            ->assertSee('Категории')
            ->assertSee('Контент')
            ->assertSee('Обновить');
    }

    public function testUpdate()
    {
        $post = Post::first();
        $params = $this->validParams();

        $response = $this->actingAsAdmin()->patch(route('admin.posts.update', $post), $params);

        $post->refresh();

        $response->assertRedirect(route('admin.posts.edit', $post));

        $this->assertDatabaseHas('posts', $params);
        $this->assertEquals($params['content'], $post->content);
    }
//
    public function testDelete()
    {
        $post = Post::first();

        $this->actingAsAdmin()
            ->delete(route('admin.posts.destroy', $post))
            ->assertStatus(302);

        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    /**
     * Valid params for updating or creating a resource
     *
     * @param  array $overrides new params
     * @return array Valid params for updating or creating a resource
     */
    private function validParams($overrides = [])
    {
        return array_merge([
            'title' => 'hello world',
            'content' => "I'm a content",
            'author_id' => $this->admin()->id,
        ], $overrides);
    }
}
