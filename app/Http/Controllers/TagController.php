<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\TagService;

class TagController extends Controller
{

    public function __construct(
        TagService $tagService
    ) {
        $this->tagService = $tagService;
    }

    /**
     * get all tags
     *
     */
    public function allTags()
    {
        $rtn = $this->tagService->allTags();
        return $rtn;
    }
}
