<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    protected $fillable = [
        'visitor_id',
        'session_id',
        'ip_hash',
        'user_agent',
        'method',
        'path',
        'full_url',
        'route_name',
        'referrer',
        'status_code',
        'visited_at',
    ];

    protected function casts(): array
    {
        return [
            'visited_at' => 'datetime',
            'status_code' => 'integer',
        ];
    }
}
