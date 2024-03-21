<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

class CategoryController extends Controller
{
    function index($slugs){
        $category = ProductCategory::where('slugs',$slugs)->first();

        if ($category) {
            SEOMeta::setTitle('Category');
            SEOMeta::addMeta('title', $category->seo_title);
            SEOTools::setDescription($category->seo_description);
            SEOMeta::addKeyword($category->seo_tags);
        }

        SEOMeta::setCanonical('https://synexdigital.com' . request()->getPathInfo());
        return view('frontend.category',['slugs' => $slugs]);
    }
}
