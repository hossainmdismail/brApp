<?php

namespace App\Livewire\Frontend;
use App\Models\Banner;
use App\Models\Campaign;
use App\Models\ProductCategory;
use Livewire\Component;

class HeaderAds extends Component
{


    public function render()
    {
        $banner = Banner::all();
        $category = ProductCategory::all();
        $header_two = Campaign::where('image_type','horizontal')->first();

        return view('livewire..frontend.header-ads',[
            'banners'       => $banner,
            'categories'    => $category,
        ]);
    }
}
