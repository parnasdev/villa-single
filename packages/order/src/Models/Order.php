<?php


namespace Packages\order\src\Models;


use App\Models\Post;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Packages\pay\src\Models\WithTransaction;

class Order extends Model
{
    use SoftDeletes , WithTransaction;

    protected $fillable = [
        'user_id',
        'address_id',
        'schedule_id',
        'discount_id',
        'transfer_price',
        'discount_price',
        'transfer_id',
        'total_price',
        'attachment',
        'payment_type',
        'type',
        'status_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function address()
    {
        //
    }

    public function discount()
    {
        //
    }

    public function transfer()
    {
        //
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function (Order $order) { // before delete() method call this
            if ($order->isForceDeleting()) {
                $order->details()->delete();
            }
            // do the rest of the cleanup...
        });
    }

    public function scopeSearch(Builder $query, $keyword)
    {
        return $query->leftJoin("users", 'users.id' , '=' , 'orders.user_id')
            ->rightJoin('order_details' , 'order_details.order_id' , '=' , 'orders.id')
            ->rightJoin('posts' , 'posts.id' , '=' , 'order_details.post_id')
            ->select(['users.name' , 'posts.title', 'users.family', 'users.phone' , 'orders.*'])
            ->where('users.name' , 'like' , "%{$keyword}%")
            ->orWhere('users.family' , 'like' , "%{$keyword}%")
            ->orWhere('users.phone' , 'like' , "%{$keyword}%")
            ->orWhere('posts.title' , 'like' , "%{$keyword}%");
    }
}
