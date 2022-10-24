<?php

namespace App\Repositories;

use App\Models\Tag;

/**
 * Class TagRepository
 * @package App\Repositories
 * @method Tag all()
 * @method Tag get($id)
 * @method Tag insert($request)
 * @method Tag remake()
 * @method Tag delete($id)
 * 
 */
class TagRepository 
{
    /**
     * Model
     *
     * @return string
     */
    protected function model()
    {
        return Tag::class;
    }

    /**
     * get all tags
     *
     * @return collection
     */
    public function allTags()
    {
        return $this->model()::all();

    }
}