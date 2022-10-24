<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'content',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * Relation to tag table
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
