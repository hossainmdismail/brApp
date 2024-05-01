<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\ProductCategory;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class FrontendController extends Controller
{
    //home
    function home()
    {
        //Meta SEO
        //SEOMeta::addMeta('title', 'Synex Digital | IT Solutions For Your Business Online Presence');
        $config = Config::first();
        SEOMeta::setTitle('Home');
        SEOTools::setDescription('Explore a wide range of stylish undergarments for girls in Dhaka, Bangladesh. From bras to panties, find the perfect fit for every occasion. Shop now and enjoy fast delivery!');
        SEOMeta::addKeyword(['business it solutions', 'service business definition', 'business communication solution']);
        SEOMeta::setCanonical('https://poddoja.com' . request()->getPathInfo());
        $category = ProductCategory::all();
        if ($config) {
            SEOMeta::setCanonical($config->url . request()->getPathInfo());
        }

        // dd($header_one);
        return view('frontend.index', [
            'categories'    => $category,
        ]);
    }
}
