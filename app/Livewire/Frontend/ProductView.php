<?php

namespace App\Livewire\Frontend;

use App\Helpers\CookieSD;
use App\Models\Product;
use Livewire\Component;

class ProductView extends Component
{
    public $slugs;

    public $qnts = 1;

    public function addToCart($productId,$qnt = null)
    {
        // dd($this->qnts);
        if (Product::find($productId)->stock_status == 0) {
            return back();
        }

        $quantity = $qnt?$qnt:1;
        CookieSD::addToCookie($productId, $quantity);
        // Emit an event to notify other components
        $this->dispatch('post-created');
    }

    public function incrementQuantity()
    {
        $this->qnts++;
    }

    public function decrementQuantity()
    {
        $this->qnts--;
    }

    public function orderNow($productId,$qnt = null){

    }

    public function render()
    {
        $product = Product::where('slugs',$this->slugs)->first();
        $relatedProduct = null;
        if ($product->category->id) {
            $relatedProduct = Product::where('category_id', $product->category->id)->get();
        }
        return view('livewire.frontend.product-view',[
            'product' => $product,
            'related' => $relatedProduct
        ]);
    }
}
