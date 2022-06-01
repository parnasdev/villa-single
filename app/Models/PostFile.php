<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'title',
        'alt',
        'type',
        'private_path',
        'post_fileable_id',
        'post_fileable_type'
    ];

    protected $casts = [
        'private_path' => 'boolean'
    ];

    public function post_fileable()
    {
        return $this->morphTo();
    }
}
