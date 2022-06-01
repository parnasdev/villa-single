<?php

namespace App\Models;

use App\Models\Extra\WithPostFile;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory ,  Sluggable , SluggableScopeHelpers , WithPostFile;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'category_type',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class , 'parent_id' , 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id' , 'id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function(Category $category) { // before delete() method call this
            $category->posts()->detach();
            $category->categories()->delete();
        });
    }

    public function scopeSearch($query , $keyword)
    {
        return $query->where("name" , 'regexp' ,  '(^|[[:space:]])'.$keyword.'([[:space:]]|$)');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
