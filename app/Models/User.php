<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Packages\Villa\src\Models\Residence;

class User extends Authenticatable
{
    use HasFactory, Notifiable , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'family',
        'email',
        'username',
        'phone',
        'role_id',
        'password',
        'email_verified_at',
        'phone_verified_at',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function residences() {
        return $this->hasMany(Residence::class);
    }

    public function hasRole($role) {
        if (is_string($role)) {
            return $this->role->contains('name', $role);
        }

//        foreach ($role as $r)
//        {
//            if ($this->hasRole($r->name)){
//                return true;
//            }
//        }
//        return false;

        return !!$role->where('name' , $this->role->name)->count();
    }

    public function scopeSearch($query , $keyword)
    {
        return $query->where("name" , 'regexp' ,  '(^|[[:space:]])'.$keyword.'([[:space:]]|$)')
            ->orWhere("family" , 'regexp' ,  '(^|[[:space:]])'.$keyword.'([[:space:]]|$)')
            ->orWhere("phone" , 'regexp' ,  $keyword.'%');
    }

    public static function boot() {
        parent::boot();

        static::restoring(function(User $user) {
            $check = User::query()->where('phone' , $user->phone)->orWhere('username' , $user->username)->orWhere('email' , $user->email)->get();
            if ($check->isNotEmpty()) {
                return false;
            }
        });
    }
}
