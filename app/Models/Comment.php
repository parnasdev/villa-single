<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'user_id',
        'name',
        'email',
        'body',
        'approved',
        'commentable_id',
        'commentable_type',
        'rate',
    ];

    protected $casts = [
        'approved' => 'boolean'
    ];

    public function commentable()
    {
        return $this->morphTo()->withTrashed();
    }

    public function comments() {
        return $this->hasMany(Comment::class , 'parentId' , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
