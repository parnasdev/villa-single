<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table ='city';

    use HasFactory;

    protected $fillable = [
        'id',
        'province_id',
        'title',
        'created_at',
        'updated_at',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }



    public static function boot() {
        parent::boot();
//
//        static::deleting(function(Category $category) { // before delete() method call this
//            $category->posts()->detach();
//            $category->categories()->delete();
//        });
    }

}
