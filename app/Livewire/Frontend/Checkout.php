<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Shipping;
use App\Helpers\CookieSD;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Models\OrderProduct;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;


class Checkout extends Component
{
    public $shipping_id = null;
    public $message = null;

    #[Validate('required')]
    public $shippingPrice = null;

    #[Validate('required|string|min:4')]
    public $name = '';

    #[Validate('required|string|min:11|max:11')]
    public $number = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $address = '';

    #[On('post-created')]
    public function updatePostList()
    {
    }


    public function increment($id){
        CookieSD::increment($id);
        $this->dispatch('post-created');
    }

    public function decrement($id){
        CookieSD::decrement($id);
        $this->dispatch('post-created');
    }

    public function remove($id)
    {
        CookieSD::removeFromCookie($id);
        $this->dispatch('post-created');
    }

    public function save(){
        $this->validate();
        if($this->shippingPrice == 0){
            return back();
        }

        if (CookieSD::data()['total'] == 0) {
            $this->addError('cart', 'Cart is empty');
            return;
        }

        //getting cookie data
        $cookieData = CookieSD::data();
        $shipping_charge = Shipping::find($this->shipping_id);

        $orderID = 'OD' . now()->format('md'). strtoupper(Str::random(4)).now()->format('Hs');


        try {
            DB::beginTransaction();

            $order = new Order();
            $order->order_id            = $orderID;
            $order->name                = $this->name;
            $order->number              = $this->number;
            $order->email               = $this->email;
            $order->address             = $this->address;
            $order->client_message      = $this->message;
            $order->shipping_charge     = $shipping_charge?$shipping_charge->price:0;
            $order->price               = $cookieData['price']+$this->shippingPrice;
            $order->order_status        = 'pending';
            $order->payment_status      = 'processing';
            $order->save();

            foreach ($cookieData['products'] as $value) {
                $product = Product::find($value->id);
                $product->qnt = $product->qnt - $value->quantity;
                $product->save();

                $order_product = new OrderProduct();
                $order_product->order_id    = $order->id;
                $order_product->product_id  = $value->id;
                $order_product->price       = $value->price - ($value->price*$value->discount/100);
                $order_product->qnt         = $value->quantity;
                $order_product->save();
            }

            $this->name = '';
            $this->number = '';
            $this->address = '';
            $this->shippingPrice = 0;
            Cookie::queue(Cookie::forget('product_data'));
            $this->dispatch('post-created');

            DB::commit();

            $ids = [];
            foreach ($cookieData['products'] as $value) {
                $ids[] =$value->id;
            }

            return redirect()->route('thankyou')->with([
                'data' => $cookieData,
                'ids' => json_encode($ids),
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            $this->addError('cart', 'try again later');
            return;
        }


    }

    public function ship($id){
        $this->shipping_id = $id;

        $shipping = Shipping::find($id);
        $this->shippingPrice = $shipping->price;
    }

    // public function wallet(){
    //     $total = CookieSD::data()['price'];
    //     $this->total = $total + $this->shippingPrice;
    // }

    public function render()
    {
        $product = CookieSD::data();
        $shipping = Shipping::all();
        return view('livewire.frontend.checkout', [
            'products'  => $product,
            'shippings' => $shipping,
            'total'     => $product['price'] + $this->shippingPrice,
        ]);
    }
}
