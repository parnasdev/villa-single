<?php


namespace App\Models\Extra;


use App\Models\PostFile;

trait WithPostFile
{

    public function files()
    {
        return $this->morphMany(PostFile::class, 'post_fileable');
    }

}
