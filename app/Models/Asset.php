<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'titulo',
        'tipo',
        'disk',
        'path',
        'original_name',
        'mime_type',
        'size',
    ];

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->disk . '/' . ltrim($this->path, '/'));
    }
}