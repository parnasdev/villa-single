<?php

namespace App\Models;

use App\Models\Extra\WithPostFile;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table ='province';
    protected $fillable = [
        'id',
        'title',
        'created_at',
        'updated_at',
    ];


    public function city()
    {
        return $this->hasMany(City::class);
    }



    public static function boot()
    {
        parent::boot();
//
//        static::deleting(function(Category $category) { // before delete() method call this
//            $category->posts()->detach();
//            $category->categories()->delete();
//        });
    }

}
