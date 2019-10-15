<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    // allowing these fields to be filled in 
    protected $fillable = [
        'user_id',
        'title',
        'color',
        'active'
    ];

    protected $casts = ['active' => 'boolean'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category', 'category_id', 'article_id');
    }
}
