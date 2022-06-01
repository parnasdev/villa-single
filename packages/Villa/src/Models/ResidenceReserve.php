<?php

namespace Packages\Villa\src\Models;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PrsModules\Country\src\Models\City;
use PrsModules\Country\src\Models\Province;

class ResidenceReserve extends Model
{
    use HasFactory , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'residence_id',
        'checkIn',
        'checkOut',
        'totalPrice',
        'count',
        'user_id',
        'name',
        'family',
        'phone',
        'status_id',
    ];

    protected $casts = [
        'dates' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
