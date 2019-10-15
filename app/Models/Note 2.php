<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {
    // allowing these fields to be filled in 
    protected $fillable = [
        'user_id',
        'owner_id',
        'message'
    ];

    protected $casts = [
        //
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category', 'article_id', 'category_id');
    }
}
