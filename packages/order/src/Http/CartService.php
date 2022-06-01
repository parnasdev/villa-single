<?php


namespace Packages\order\src\Http;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CartService
{
    protected $cart;

    public function __construct()
    {
        $this->cart = session()->get('cart') ?? collect([]);
    }

    /**
     * add product to session name cart.
     *
     * @param array $value
     * @param model $obj
     * @return $this
     */
    public function put(array $value , $obj = null) {
        if (!is_null($obj) && $obj instanceof Model) {
            $value = array_merge($value , [
               'id' => Str::random(10),
               'subject_id' => $obj->id,
               'subject_type' => get_class($obj)
            ]);
        } else if (!isset($value['id'])) {
            $value = array_merge($value , [
                'id' => Str::random(10)
            ]);
        }

        $this->cart->put($value['id'] , $value);

        session()->put('cart' , $this->cart);

        return $this;
    }

    /**
     * @param $key
     * @param $option
     * @return $this
     */
    public function update($key, $option)
    {
        $item = collect($this->get($key , true));

        if (is_null($item)) {
            abort(500);
        }

        if (is_numeric($option)) {
            $item = $item->merge([
                'quantity' => $item['quantity'] + $option
            ]);
        }

        if (is_array($option)) {
            $item = $item->merge($option);
        }

        $this->put($item->toArray());

        return $this;
    }

    public function delete($key)
    {
        if ($this->has($key)) {
           $this->cart = $this->cart->filter(function ($item) use ($key) {
                return $item['id'] !== $key;
            });

           session()->put('cart' , $this->cart);

           return true;
        }

        return false;
    }

    public function deleteAll()
    {
        $this->cart = collect([]);

        session()->put('cart' , $this->cart);

        return true;
    }

    /**
     * find product in session
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        if ($key instanceof Model) {
            return !is_null($this->cart->where('subject_id' , $key->id)->where('subject_type' , get_class($key))->first());
        }

        return !is_null($this->cart->firstWhere('id' , $key));
    }

    /**
     * get a product form session
     * @param $key
     * @param bool $withRelation
     * @return mixed
     */
    public function get($key , $withRelation = true) {
            $item = $key instanceof Model ?
                $this->cart->where('subject_id' , $key->id)->where('subject_type' , get_class($key))->first()
                :
                $this->cart->firstWhere('id' , $key);

        return $withRelation ? $this->withRelationShip($item) : $item;
    }

    /**
     * get all product from cart
     * @return \Illuminate\Support\Collection|mixed
     */
    public function all()
    {
        $cart = $this->cart;
        $cart = $cart->map(function ($item) {
            return $this->withRelationShip($item);
        });

        return $cart;
    }

    /**
     * get count cart.
     * @param null $key
     * @return int
     */
    public function getCount($key = null) {
        if (!is_null($key)) {
            return $this->get($key)['quantity'];
        } else {
            return $this->cart->count();
        }
    }

    protected function withRelationShip($item) {

        if (isset($item['subject_id']) && isset($item['subject_type'])) {
            $class = $item['subject_type'];
            $subject = (new $class())->find($item['subject_id']);
            $item[strtolower(class_basename($class))] = $subject;
            unset($item['subject_id']);
            unset($item['subject_type']);
            return $item;
        }

        return $item;
    }
}
