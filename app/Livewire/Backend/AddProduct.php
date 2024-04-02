<?php

namespace App\Livewire\Backend;

use App\Models\Color;
use App\Models\Service;
use Livewire\Component;
use App\Models\ProductCategory;
use App\Models\Size;

class AddProduct extends Component
{
    public function render()
    {
        $service = Service::get();
        $categories = ProductCategory::get();
        $color = Color::get();
        $size = Size::get();
        return view(
            'livewire.backend.add-product',
            [
                'categories'    => $categories,
                'services'      => $service,
                'colors'        => $color,
                'sizes'         => $size,
            ]
        );
    }
}
