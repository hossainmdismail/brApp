<?php

namespace App\Livewire\Frontend;

use App\Helpers\CookieSD;
use Livewire\Attributes\On;
use Livewire\Component;

class ShoppingCart extends Component
{
    #[On('post-created')]
    public function updatePostList()
    {
    }


    public function remove($id)
    {
        CookieSD::removeFromCookie($id);
        $this->dispatch('post-created');
        // dd(CookieSD::getProductData());
        //dd(CookieSD::data()['products']);
    }


    public function render()
    {

        //dd(CookieSD::data()['products']);

        // $total_price = count($products)
        return view('livewire..frontend.shopping-cart', [
            'products'  => CookieSD::data()['products'],
            'price'     => CookieSD::data()['price'],
            'total'     => CookieSD::data()['total'],
        ]);
    }
}
