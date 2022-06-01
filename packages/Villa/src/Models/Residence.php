<?php

namespace Packages\Villa\src\Models;

use App\Models\Category;
use App\Models\City;
use App\Models\Province;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Residence extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'province_id',
        'user_id',
        'city_id',
        'residence_owner',
        'mobile',
        'description',
        'address',
        'coordinates',
        'building_area',
        'twinBed',
        'singleBed',
        'mattress',
        'land_area',
        'capacity',
        'maxCapacity',
        'room_count',
        'rules',
        'specifications',
        'status_id',
    ];

    protected $casts = [
        'images' => 'array',
        'coordinates' => 'array',
        'rules' => 'array',
        'specifications' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function path(){

    }
    public function residences()
    {
        return $this->belongsTo(Residence::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function residenceFiles()
    {
        return $this->hasMany(ResidenceFile::class);
    }

    public function residenceDates()
    {
        return $this->hasMany(ResidenceDate::class);
    }
    public function residenceReserves()
    {
        return $this->hasMany(ResidenceReserve::class);
    }
}
