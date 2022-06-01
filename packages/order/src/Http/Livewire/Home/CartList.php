<?php


namespace Packages\order\src\Http\Livewire\Home;

use Illuminate\Routing\Route;
use Livewire\Component;
use Packages\order\src\Http\Cart;
use Packages\order\src\Models\Order;
use Packages\pay\src\Models\Transaction;
use Shetabit\Multipay\Exceptions\PurchaseFailedException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class CartList extends Component
{

    public $portSelected = 'zarinpal';
    public $SumBasePrice = 0;
    public $SumOfferPrice = 0;
    public $type = 'online';

    public function render()
    {
        $carts = Cart::all();
        return view('order::livewire.home.cart-list', compact('carts'));
    }

    public function mount()
    {

        $this->SumBasePrice = Cart::all()->pluck('post')->sum(function ($item) {
            return $item->options['price'];
        });
        $this->SumOfferPrice = Cart::all()->pluck('post')->sum(function ($item) {
            return $item->options['offer_price'];
        });
    }

    public function deleteItem($id)
    {
        $result = Cart::delete($id);

        if (!$result) {
            $this->dispatchBrowserEvent('toastMessage', ['message' => 'خطا در حذف', 'icon' => 'error']);
            return;
        }
        $this->render();
        $this->dispatchBrowserEvent('toastMessage', ['message' => 'عملیات با موفقبت انجام شد.', 'icon' => 'success']);

        $this->emit('updateCart');
    }

    public function pay()
    {

        if (!auth()->check()) {
            $this->dispatchBrowserEvent('toastMessage', ['message' => 'شما به سایت ورود نکرده اید', 'icon' => 'error']);
            return redirect(route('login'));
        }

        $order = user()->orders()->create([
            'total_price' => $this->SumBasePrice - $this->SumOfferPrice,
            'payment_type' => $this->type == 'online' ? $this->portSelected : $this->type,
            'type' => 'factor',
            'status_id' => config('order.enums.status.waitforpay')
        ]);

        foreach (Cart::all() as $cart) {
            $order->details()->create([
                'post_id' => $cart['post']->id,
                'quantity' => 1,
                'price' => $cart['post']->options['price'],
                'offer_price' => $cart['post']->options['offer_price'],
                'total_price' => $cart['post']->options['offer_price'] > 0 ? $cart['post']->options['offer_price'] : $cart['post']->options['price'],
            ]);
        }

        Cart::deleteAll();
        return redirect(route('pay.purchase', ['order' => $order->id]));
    }

    public function changeType($type)
    {
        $this->type = $type;
    }
}
