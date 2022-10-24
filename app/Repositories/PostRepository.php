<?php

namespace App\Repositories;

use App\Models\Post;

/**
 * Class UserRepository
 * @package App\Repositories
 * @method User all()
 * @method User get($id)
 * @method User insert($request)
 * @method User remake()
 * @method User delete($id)
 * 
 */
class PostRepository 
{
    /**
     * Model
     *
     * @return string
     */
    protected function model()
    {
        return Post::class;
    }

    /**
     * create new post and attach tags
     *
     * @return collection
     */
    public function createPost($attributes,$tags)
    {
        return $this->model()::create($attributes)->tags()->attach($tags);
  
    }
}