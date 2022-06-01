<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id',
        'title',
        'icon',
        'parent',
        'href',
        'is_link',
        'image',
        'order_item',
    ];

    protected $casts = [
        'is_link' => 'boolean'
    ];
}
