<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class CategoryController extends Controller
{
    function index($slugs)
    {
        $category = ProductCategory::where('slugs', $slugs)->first();

        $config = Config::first();
        if ($category) {
            SEOMeta::setTitle('Category');
            SEOMeta::addMeta('title', $category->seo_title);
            SEOTools::setDescription($category->seo_description);
            SEOMeta::addKeyword($category->seo_tags);
        }

        if ($config) {
            SEOMeta::setCanonical($config->url . request()->getPathInfo());
        }
        return view('frontend.category', ['slugs' => $slugs]);
    }
}
