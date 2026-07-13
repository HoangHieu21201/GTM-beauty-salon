<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'category_id', 'name', 'address', 'phone', 'website', 
    'description', 'image', 'score', 'rating', 'review_count', 
    'is_featured', 'status'
])]
class Salon extends Model
{
    use SoftDeletes;

    protected $casts = [
        'is_featured' => 'boolean',
        'rating' => 'decimal:1',
        'score' => 'integer',
        'review_count' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'salon_post');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
