<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'slug', 'region'])]
class Province extends Model
{
    public $incrementing = false; // predefined IDs
    public $timestamps = false; // no timestamps in schema

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_province');
    }
}
