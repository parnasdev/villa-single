<?php


namespace Packages\pay\src\Models;


use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Packages\pay\src\database\factories\TransactionFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'resnumber',
        'enter_port_at',
        'exit_port_at',
        'details',
        'status_id',
        'transactiontable_type',
        'transactiontable_id'
    ];

    protected $casts = [
        'details' => 'array'
    ];

    public function transactiontable()
    {
        $this->morphTo();
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function scopeSearch($query , $keyword)
    {
        return $query;
    }

    protected static function newFactory()
    {
        return TransactionFactory::new();
    }
}
