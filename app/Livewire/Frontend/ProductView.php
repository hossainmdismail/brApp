<?php

namespace App\Livewire\Frontend;

use App\Helpers\CookieSD;
use App\Models\Product;
use Livewire\Component;

class ProductView extends Component
{
    public $id, $product, $price, $discount, $finalPrice, $type;

    public $qnts = 1;

    public function addToCart($productId, $qnt = null)
    {
        // dd($this->qnts);
        if (Product::find($productId)->stock_status == 0) {
            return back();
        }

        $quantity = $qnt ? $qnt : 1;
        CookieSD::addToCookie($productId, $quantity);
        // Emit an event to notify other components
        $this->dispatch('post-created');
    }


    public function mount()
    {
        // $this->name = Auth::user()->name;
        $this->product = Product::find($this->id);

        if ($this->product->attributes->first()) {
            $this->discount = $this->product->attributes->first()->getFinalPrice();
            $this->price = $this->product->attributes->first()->s_price;
            $this->finalPrice = $this->product->attributes->first()->price;
            $this->type = $this->product->attributes->first()->sp_type;
        } else {
            $this->price = 0;
        }
    }

    public function incrementQuantity()
    {
        $this->qnts++;
    }

    public function decrementQuantity()
    {
        $this->qnts--;
    }

    public function orderNow($productId, $qnt = null)
    {
    }

    public function render()
    {
        return view('livewire.frontend.product-view', [
            'product' => $this->product,
            // 'related' => $relatedProduct
        ]);
    }
}
