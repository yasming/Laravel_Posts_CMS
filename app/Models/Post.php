<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'content',
        'tags'
    ];

    protected $casts = [
        'tags' => 'array'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeSearchByTag($query)
    {
        return  $query->when(request()->query('tag'), function($query){
                    return $query->whereJsonContains('tags',request()->query('tag'));
                })->get();
    }
}
