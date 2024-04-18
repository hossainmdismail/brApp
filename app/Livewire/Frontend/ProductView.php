<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use App\Helpers\CookieSD;

class ProductView extends Component
{
    public $id, $product, $sizes = [], $quantity = 1, $color_id, $size_id;

    protected $rules = [
        'quantity'  => 'required|numeric|min:1|max:100', // Example: min value is 1 and max value is 100
        'color_id'  => 'required',
        'size_id'   => 'required',
    ];

    public function addToCart()
    {
        $this->validate();

        $data = $this->product->attributes()->where('color_id', $this->color_id)->where('size_id', $this->size_id)->first();
        if ($data) {
            CookieSD::addToCookie($data->id, $this->quantity);
            $this->dispatch('post-created');
        }
    }

    public function mount()
    {
        // $this->name = Auth::user()->name;
        $this->product = Product::find($this->id);
    }


    public function sizeByColor($id)
    {
        $this->color_id = $id;
        $size = $this->product->getSizesByColor($id);
        $this->sizes = $size;
        $this->size_id = null;
    }

    public function sizeAction($id)
    {
        $this->size_id = $id;
        // $data = $this->product->attributes()->where('color_id', $this->color_id)->where('size_id', $id)->first();
        // if ($data) {
        //     dd($data);
        // }
    }

    // public function incrementQuantity()
    // {
    //     $this->qnts++;
    // }

    // public function decrementQuantity()
    // {
    //     $this->qnts--;
    // }

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
