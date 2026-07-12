<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'user_id', 'category_id', 'title', 'slug', 'short_description', 
    'content', 'thumbnail', 'status', 'keyword', 'meta_title', 'meta_description'
])]
class Post extends Model
{

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function provinces(): BelongsToMany
    {
        return $this->belongsToMany(Province::class, 'post_province');
    }

    public function salons(): BelongsToMany
    {
        return $this->belongsToMany(Salon::class, 'salon_post');
    }
}
