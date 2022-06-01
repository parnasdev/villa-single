<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'is_access_panel',
        'is_access_dashboard',
        'is_custom',
        'see_all_post',
        'is_default',
        'custom_route_name_access'
    ];

    protected $casts = [
        'is_access_panel' => 'boolean',
        'is_access_dashboard' => 'boolean',
        'is_custom' => 'boolean',
        'see_all_post' => 'boolean',
        'is_default' => 'boolean',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
