<?php

namespace App\Services;

use App\Repositories\TagRepository;

class TagService
{
    public function __construct(
        TagRepository $tagRepository
    ) {
        $this->tagRepository = $tagRepository;
    }

    /**
     * get all tags
     *
     * @return array
     */
    public function allTags()
    {
        $rtn = $this->tagRepository->allTags();

        return $rtn;
    }

}
