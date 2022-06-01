<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name' , 'value'
    ];

    public function getValueAttribute()
    {
        $data = @unserialize($this->attributes['value']);
        if ($data !== false) {
            return $data;
        } else {
            return $this->attributes['value'];
        }
    }

    public function setValueAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['value'] = serialize($value);
        } else {
            $this->attributes['value'] = $value;
        }
    }
}
