<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Product;
use App\Models\Shipping;
use App\Helpers\CookieSD;
use App\Models\CustomLink;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

class ProductController extends Controller
{
    public function single($slugs)
    {

        $product = Product::where('slugs', $slugs)->first();
        $config = Config::first();
        $relatedProduct = null;
        if ($product->category) {
            $relatedProduct = Product::where('category_id', $product->category->id)->get();
        }

        if ($product) {
            SEOMeta::setTitle('Product');
            SEOMeta::addMeta('title', $product->seo_title);
            SEOTools::setDescription($product->seo_description);
            SEOMeta::addKeyword($product->seo_tags);
        }
        if ($config) {
            SEOMeta::setCanonical($config->url . request()->getPathInfo());
        }

        return view('frontend.productView', [
            'product' => $product,
            'related' => $relatedProduct,
            'config'  => $config,

        ]);
    }

    public function cart(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'qnt'   => 'required',
            'id'    => 'required',
            'btn'   => 'required',
        ]);

        try {
            CookieSD::addToCookie($request->id, $request->qnt);
        } catch (\Exception $e) {
            // Catch the exception and redirect back with a warning message
            return back()->with('err', 'Warning: ' . $e->getMessage());
        }

        // Facebook Pixel events
        if ($request->btn == 'cart' || $request->btn == 'buy') {
            $product = Product::find($request->id);


            if ($request->btn == 'buy') {
                return redirect()->route('checkout')->with(['add', $product]);
            }

            return back()->with(['add' => $product, 'qnt' => $request->qnt]);
        }
    }

    public function landing($slugs)
    {
        $code = CustomLink::first();
        $product = Product::where('slugs', $slugs)->first();
        $config = Config::first();
        $shipping = Shipping::get();
        $relatedProduct = null;
        if ($product->category) {
            $relatedProduct = Product::where('category_id', $product->category->id)->get();
        }
        $availableColors = [];
        if ($product->attributes->isNotEmpty()) {
            $availableColors = $product->attributes->groupBy('color_id')->map(function ($items) {
                // Get the first item in the group to fetch color and image details
                $color = $items->first()->color;
                $colorImage = $items->first()->image ?? 'path_to_default_image.jpg'; // Provide default image if null

                return [
                    'id' => $color->id,              // Color ID
                    'name' => $color->name,          // Color name
                    'code' => $color->code,          // Color code (for display)
                    'image' => $colorImage,          // Image for the color
                    'inventory_id' => $items->first()->id,  // Inventory ID for the first color-size combination
                    'sizes' => $items->map(function ($item) {
                        return [
                            'inventory_id' => $item->id,       // Specific Inventory ID for this size
                            'size_id' => $item->size->id ?? null,
                            'size_name' => $item->size->name ?? 'N/A',
                            'stock' => $item->qnt,            // Stock for this color-size combination
                        ];
                    }),
                ];
            })->values(); // Use values() to get a numeric array

            // Convert collection to array to ensure it's usable in JSON
            $availableColors = $availableColors->toArray();
        }

        if ($product) {
            SEOMeta::setTitle('Product');
            SEOMeta::addMeta('title', $product->seo_title);
            SEOTools::setDescription($product->seo_description);
            SEOMeta::addKeyword($product->seo_tags);
        }
        if ($config) {
            SEOMeta::setCanonical($config->url . request()->getPathInfo());
        }

        return view('frontend.landingView', [
            'product' => $product,
            'related' => $relatedProduct,
            'availableColors' => $availableColors,  // Pass colors and sizes to the view
            'shippings' => $shipping,
            'config'  => $config,
            'code'  => $code,
        ]);
    }
}
