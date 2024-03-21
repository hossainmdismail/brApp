<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPhoto;
use App\Models\ProductQuantity;
use App\Models\ProductService;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Photo;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $service = Service::all();
        $categories = ProductCategory::all();

        if ($categories->isEmpty()) {
            return redirect()->route('category.create')->with('err', 'Add category before product');
        }elseif ($service->isEmpty()) {
            return redirect()->route('variation.create')->with('err', 'Add service before product');
        }

        return view('backend.product.create_product', [
            'categories' => $categories,
            'services'   => $service,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'btn'               => 'required',
            'category_id'       => 'required|integer',
            'product_name'      => 'required',
            'short_description' => 'required',
            'description'       => 'required',
            'price'             => 'required|integer',
            'stk_price'         => 'required|integer',
            'qnt'               => 'required',
            'service'           => 'required|array|present',
            'images'            => 'required|array|present',
        ]);

        $sku = 'SK'. now()->format('mdH'). strtoupper(Str::random(4)). now()->format('is');
        $slug = Str::slug($request->product_name);

        // Check if the slug already exists, append numeric value if necessary
        $count = Product::where('slugs', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        // dd($request->all());

        DB::beginTransaction();

        try {

            $product = new Product();
            $product->category_id       = $request->category_id;
            $product->name              = $request->product_name;
            $product->slugs             = $slug;
            $product->short_description = $request->short_description;
            $product->description       = $request->description;
            $product->discount          = $request->discount;
            $product->price             = $request->price;
            $product->video_link        = $request->link;
            $product->qnt	            = $request->qnt;
            $product->status            = $request->btn;
            $product->featured          = $request->featured == 'on' ? 1 : 0;
            $product->popular           = $request->popular == 'on' ? 1 : 0;
            $product->sku               = $sku;
            $product->qnt               = $request->qnt;
            $product->seo_title         = $request->seo_title;
            $product->seo_description   = $request->seo_description;
            $product->seo_tags          = $request->seo_tags;
            $product->sku               = 'SK' . now()->format('md'). strtoupper(Str::random(3)). now()->format('Hi');
            $product->save();

            $product_id = $product->id;

            if ($product) {

                $product_qnt = new ProductQuantity();
                $product_qnt->product_id    = $product_id;
                $product_qnt->quantity      = $request->qnt;
                $product_qnt->sale_price    = $request->price;
                $product_qnt->stock_price   = $request->stk_price;
                $product_qnt->save();

                foreach ($request->service as $service) {
                    ProductService::insert([
                        'product_id' => $product_id,
                        'service_id' => $service,
                        'created_at' => Carbon::now(),
                    ]);
                }

                foreach ($request->images as  $image) {
                    Photo::upload($image, 'files/product',  $product_id . 'PRO', [1100, 1100]);
                    ProductPhoto::insert([
                        'product_id'    => $product_id,
                        'image'         => Photo::$name,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('err', 'Failed to add product, try again.');
        }

        return back()->with('succ', 'Product added successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $services = Service::all();
        $request = Product::find($id);
        $categories = ProductCategory::all();
        return view('backend.product.edit_product', compact('request', 'categories', 'services'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'btn'               => 'required',
            'category_id'       => 'required|integer',
            'product_name'      => 'required',
            'short_description' => 'required',
            'description'       => 'required',
            'price'             => 'required|integer',
            'stk_price'         => 'required|integer',

        ]);

        $slug = Str::slug($request->product_name);

        // Check if the slug already exists, append numeric value if necessary
        $count = Product::where('slugs', $slug)->count();
        if ($count > 1) {
            $slug = $slug . '-' . ($count + 1);
        }

        DB::beginTransaction();

        try {
            $product = Product::find($id);
            $product->category_id       = $request->category_id;
            $product->name              = $request->product_name;
            $product->slugs             = $slug;
            $product->short_description = $request->short_description;
            $product->description       = $request->description;
            $product->discount          = $request->discount;
            $product->price             = $request->price;
            $product->video_link        = $request->link;
            $product->status            = $request->btn;
            $product->seo_title         = $request->seo_title;
            $product->seo_description   = $request->seo_description;
            $product->seo_tags          = $request->seo_tags;

            // Update the related ProductQuantity based on the first item
            $firstProductQuantity = $product->stockItem->sortByDesc('created_at')->first();

            if ($request->qnt && $request->qnt != 0) {
                //new qnt update
                $productQuantity = new ProductQuantity();
                $productQuantity->product_id  = $id;
                $productQuantity->quantity    = $request->qnt;
                $productQuantity->sale_price  = $request->price;
                $productQuantity->stock_price = $request->stk_price;
                $productQuantity->save();

                //Product qnt update
                $product->qnt = $product->qnt + $request->qnt;
            }elseif ($firstProductQuantity) {
                $firstProductQuantity->sale_price  = $request->price;
                $firstProductQuantity->stock_price = $request->stk_price;
            }

            $product->save();
            $firstProductQuantity->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('err', 'Failed to add product, try again.');
        }

        return back()->with('succ', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
