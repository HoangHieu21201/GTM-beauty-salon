<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salon extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'address',
        'phone',
        'website',
        'description',
        'image',
        'score',
        'rating',
        'review_count',
        'is_featured',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'rating' => 'decimal:1',
            'review_count' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'salon_id');
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'salon_post');
    }
}
