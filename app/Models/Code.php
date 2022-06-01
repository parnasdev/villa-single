<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Code extends Model
{
    use HasFactory , Notifiable;

    protected $fillable = [
        'username',
        'username_type',
        'token',
        'token_type',
        'used',
        'expire_at',
    ];

    protected $casts = [
        'used' => 'boolean'
    ];

    public function routeNotificationForKavenegar($driver, $notification = null)
    {
        return $this->username;
    }
}
