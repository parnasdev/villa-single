<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'is_guest',
        'useragent',
        'visit_count',
        'visitable_id',
        'visitable_type',
    ];


    protected $casts = [
        'is_guest' => 'boolean'
    ];

    public function visitable()
    {
        return $this->morphTo()->withTrashed();
    }
}
