<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_searches',
        'top_queries',
        'computed_at'
    ];

    protected $casts = [
        'top_queries' => 'array',
        'computed_at' => 'datetime'
    ];
}
