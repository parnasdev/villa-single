<?php


namespace App\Models\Extra;




use App\Models\Comment;

trait WithComment
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
