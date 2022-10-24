<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(
        PostService $postService
    ) {
        $this->postService = $postService;
    }

    public function createPost() 
    {
        $rtn = $this->postService->createPost();

        return $rtn;
    }
}
