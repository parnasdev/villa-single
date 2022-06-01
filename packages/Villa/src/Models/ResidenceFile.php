<?php

namespace Packages\Villa\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResidenceFile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'residence_id',
        'url',
        'alt',
        'type',
    ];

    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }

}
