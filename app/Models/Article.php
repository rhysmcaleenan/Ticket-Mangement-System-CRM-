<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Parsedown;

class Article extends Model {

    protected $fillable = [
        'user_id',
        'title',
        'issue',
        'solution',
        'file',
        'active'
    ];

    protected $casts = ['active' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_category', 'article_id', 'category_id');
    }

    public function toHtml()
    {
        return Parsedown::instance()->text($this->content);
    }
}
