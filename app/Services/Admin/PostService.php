<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Services\AdminServiceInterface;
use Debugbar;

class PostService implements AdminServiceInterface
{
    /**
     * Creates new resource.
     *
     * @param array $data
     *
     * @return bool
     */
    public function create(array $params)
    {
        $image_id = null;
        if(!empty($params['thumbnail_id'])){
            $image = Image::createImage();
            $image_id = $image->id;
        }elseif(!empty($params['thumbnail_name'])){
            $image_id = Image::whereName($params['thumbnail_name'])->first()->id;
        }

        $data = [
            'title' => $params['title'],
            'content' => $params['content'],
            'author_id' => $params['author_id'],
            'thumbnail_id' => $image_id,
            'status' => $params['status'],
        ];
        $post = Post::create($data);

        if(!empty($params['categories'])){
            $post->categories()->sync($params['categories']);
        }

        return $post;
    }

    /**
     * Updates the resource.
     *
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function update(array $params)
    {
        $post = $params['post'];

        $image_id = null;
        if(!empty($params['thumbnail_id'])){
            $image = Image::createImage();
            $image_id = $image->id;
        }elseif(!empty($params['thumbnail_name'])){
            $image_id = Image::whereName($params['thumbnail_name'])->first()->id;
            unset($params['validated']['thumbnail_name']);
        }

        /**
         * Status by default false
         * Ability to update status published
         */
        $post->fill([
            'title' => $params['title'],
            'content' => $params['content'],
            'author_id' => $params['author_id'],
            'thumbnail_id' => $image_id,
            'status' => $params['status'],
        ]);

        $status = $params['status'];
        if($post->isDirty('title') || $post->isDirty('content') || $post->isDirty('author_id') || $post->isDirty('thumbnail_id')){
            $status = false;
        }

        $post->update([
            'title' => $params['title'],
            'content' => $params['content'],
            'author_id' => $params['author_id'],
            'thumbnail_id' => $image_id,
            'status' => $status,
        ]);
        if(!empty($params['categories'])){
            $post->categories()->sync($params['categories']);
        }

        return $post;
    }

    /**
     * Deletes the resource.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id)
    {

    }

}
