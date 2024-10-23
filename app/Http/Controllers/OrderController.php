<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Config;
use App\Models\Shipping;
use App\Models\Inventory;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomLink;

class OrderController extends Controller
{
    function thankyou()
    {
        return view('frontend.thankyou');
    }

    function thankyouLanding()
    {
        $config = Config::first();
        $code = CustomLink::first();
        return view('frontend.thankyouLanding', [
            'config'  => $config,
            'code'  => $code,
        ]);
    }

    public function landingOrder(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'number'    => ['required', 'regex:/^01[3-9]\d{8}$/'],
            'shipping'  => 'required',
            'quantity'   => 'required',
            'address'   => 'required',
            'email'     => 'nullable|email',
        ], [
            'number.regex' => 'দয়া করে একটি বৈধ বাংলাদেশি ফোন নম্বর দিন (0180-000-000)',
            'shipping' => 'দয়া করে শিপিং এরিয়া নির্বাচন করুন।',
        ]);

        $new = Inventory::find($request->inventory_id);
        $shipping = Shipping::find($request->shipping);
        $config = Config::first();
        $code = CustomLink::first();
        // dd($shipping);

        if ($new && $shipping) {
            $orderID = str_pad(Order::max('id') + 1, 5, '0', STR_PAD_LEFT);
            $price = $new->product->getFinalPrice();

            $order = new Order();
            $order->order_id            = $orderID;
            $order->name                = $request->name;
            $order->number              = $request->number;
            $order->address             = $request->address;
            $order->client_message      = $request->message;
            $order->shipping_charge     = $shipping->price;
            $order->price               = ($price * $request->quantity) + $shipping->price;
            $order->order_status        = 'pending';
            $order->payment_status      = 'processing';
            $order->save();

            $order_product = new OrderProduct();
            $order_product->order_id    = $order->id;
            $order_product->product_id  = $new->id;
            $order_product->price       = $price;
            $order_product->qnt         = $request->quantity;
            $order_product->save();

            return view('frontend.thankyouLanding', [
                'config' => $config,
                'order'  => $order,
                'code'  => $code,
            ]);
        } else {
            return back()->with('err', 'Product not found!');
        }

        // return redirect()->route('landing.thankyou');
    }
}
