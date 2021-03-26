<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory(3)
            ->create();

        Post::factory()
            ->count(5)
            ->create()
            ->each(
                fn($post) => $post->categories()->sync($categories->random())
            );
    }
}
