<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
    public function __construct(
        PostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    /**
     * create a new post
     *
     * @return array
     */
    public function createPost()
    {
        $attributes = [
            'title' => request()->input('title'),
            'content' => request()->input('content'),
        ];
        $tags = request()->input('tagsSelected'); 
        
        $rtn = $this->postRepository->createPost($attributes,$tags);

        return $rtn;
    }

}
