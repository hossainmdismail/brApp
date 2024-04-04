<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Service;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductService;
use Illuminate\Support\Carbon;
use App\Models\ProductCategory;
use App\Models\ProductQuantity;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        $service = Service::get();
        $categories = ProductCategory::get();
        $color = Color::get();
        $size = Size::get();

        if ($categories->isEmpty()) {
            return redirect()->route('category.create')->with('err', 'Add category before product');
        } elseif ($service->isEmpty()) {
            return redirect()->route('variation.create')->with('err', 'Add service before product');
        }

        return view('backend.product.create_product', [
            'categories'    => $categories,
            'services'      => $service,
            'colors'        => $color,
            'sizes'         => $size,
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
            // 'price'             => 'required|array|present',
            // 'price.*'           => 'required|integer',
            // 'sku'               => 'required|array|present',
            // 'sku.*'             => 'required',
            // 'stock_price'       => 'required|array|present',
            // 'stock_price.*'     => 'required|integer',
            // 's_price'           => 'required|array|present',
            // 's_price.*'         => 'required|integer',
            // 'sp_type'           => 'required|array|present',
            // 'sp_type.*'         => 'required|string',
            // 'qnt'               => 'required|array|present',
            // 'qnt.*'             => 'required|integer',
            // 'color_id'          => 'required|array|present', // Validate color_id array is present
            // 'color_id.*'        => 'required|integer', // Validate each element of color_id is an integer
            // 'size_id'           => 'required|array|present', // Validate size_id array is present
            // 'size_id.*'         => 'required|integer', // Validate each element of size_id is an integer
            'service'           => 'required|array|present',
            // 'product_image.*'   => 'required',
            // 'product_image'     => 'required',
        ]);



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
            $product->video_link        = $request->link;
            $product->status            = $request->btn;
            $product->featured          = $request->featured == 'on' ? 1 : 0;
            $product->popular           = $request->popular == 'on' ? 1 : 0;
            $product->seo_title         = $request->seo_title;
            $product->seo_description   = $request->seo_description;
            $product->seo_tags          = $request->seo_tags;
            $product->save();

            $product_id = $product->id;

            if ($product) {
                // foreach ($request->sku as $key => $sku) {
                //     $variant = new Inventory();
                //     $variant->product_id    = $product_id;
                //     $variant->color_id      = $request->color_id[$key];
                //     $variant->size_id       = $request->size_id[$key];
                //     $variant->sku           = $sku;
                //     $variant->image         = $sku; //Hold
                //     $variant->stock_price   = $request->stock_price[$key];
                //     $variant->price         = $request->price[$key];
                //     $variant->s_price       = $request->s_price[$key];
                //     $variant->sp_type       = $request->sp_type[$key];
                //     $variant->qnt           = $request->qnt[$key];
                //     $variant->total_qnt     = $request->qnt[$key];
                //     $variant->save();
                // }

                foreach ($request->service as $service) {
                    ProductService::insert([
                        'product_id' => $product_id,
                        'service_id' => $service,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('err', $e->getMessage());
        }

        return back()->with('succ', 'Product added successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $services   = Service::all();
        $request    = Product::find($id);
        $categories = ProductCategory::all();
        $colors     = Color::get();
        $sizes      = Size::get();
        return view('backend.product.edit_product', compact('request', 'categories', 'services', 'colors', 'sizes'));
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
            } elseif ($firstProductQuantity) {
                $firstProductQuantity->sale_price  = $request->price;
                $firstProductQuantity->stock_price = $request->stk_price;
            }

            $product->save();
            $firstProductQuantity->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
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
