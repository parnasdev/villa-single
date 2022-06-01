<?php


namespace Packages\order\src\Http;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class Cart
 * @package Modules\Cart\Http\Cart
 * @method static bool has($id)
 * @method static Collection all()
 * @method static int getCount($id = null)
 * @method static array get($id , $withRelation)
 * @method static Cart put(array $value , Model $obj=null)
 * @method static Cart update($id , $option)
 * @method static bool delete($id)
 * @method static bool deleteAll()
 */

class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
