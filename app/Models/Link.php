<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'used',
    ];

    protected $casts = [
        'used' => 'boolean'
    ];

    public function linkContents()
    {
        return $this->hasMany(LinkContent::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function(Link $link) { // before delete() method call this
            $link->linkContents()->delete();
            // do the rest of the cleanup...
        });
    }

}
