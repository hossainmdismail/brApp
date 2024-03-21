<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\ProductCategory;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class FrontendController extends Controller
{
     //home
     function home(){
        //Meta SEO
        //SEOMeta::addMeta('title', 'Synex Digital | IT Solutions For Your Business Online Presence');
        $config = Config::first();
        SEOMeta::setTitle('Home');
        SEOTools::setDescription('We are the Synex Digital Team and are Highly Motivated to Give You The Best and effective on-time Results for Your Online Presence and Traffic Growth.');
        SEOMeta::addKeyword(['business it solutions', 'service business definition', 'business communication solution']);
        SEOMeta::setCanonical('https://synexdigital.com' . request()->getPathInfo());
        $category = ProductCategory::all();
        if ($config) {
            SEOMeta::setCanonical($config->url . request()->getPathInfo());
        }

        // dd($header_one);
        return view('frontend.index',[
            'categories'    => $category,
        ]);
    }
}
