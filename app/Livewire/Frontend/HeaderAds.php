<?php

namespace App\Livewire\Frontend;

use App\Models\Banner;
use App\Models\Campaign;
use Livewire\Component;

class HeaderAds extends Component
{


    public function render()
    {
        $banner = Banner::all();
        $header_one = Campaign::where('image_type', 'vertical')->first();
        $header_two = Campaign::where('image_type', 'horizontal')->first();

        return view('livewire..frontend.header-ads', [
            'banners'       => $banner,
            'header_one'    => $header_one,
            'header_two'    => $header_two,
        ]);
    }
}
