<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductService;
use Illuminate\Support\Carbon;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use Photo;

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
            'service'           => 'required|array|present',
            //new
            'price'             => 'required|integer',
            'stock_price'       => 'required|integer',
            's_price'           => 'required|integer',
            'sp_type'           => 'required',
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
            //new
            $product->price             = $request->price;
            $product->stock_price       = $request->stock_price;
            $product->s_price           = $request->s_price;
            $product->sp_type           = $request->sp_type;

            $product->save();

            $product_id = $product->id;

            if ($product) {
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
        dd($id);
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
            //new
            'price'             => 'required|integer',
            'stock_price'       => 'required|integer',
            's_price'           => 'required|integer',
            'sp_type'           => 'required',
        ]);

        $slug = Str::slug($request->slugs);

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
            // $product->video_link        = $request->link;
            $product->status            = $request->btn;
            $product->seo_title         = $request->seo_title;
            $product->seo_description   = $request->seo_description;
            $product->seo_tags          = $request->seo_tags;
            //new
            $product->price             = $request->price;
            $product->stock_price       = $request->stock_price;
            $product->s_price           = $request->s_price;
            $product->sp_type           = $request->sp_type;

            $product->save();

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

    public function customeReview(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
            'rating' => 'required',
            'comment' => 'required',
        ]);

        if ($request->has('image')) {
            Photo::upload($request->image, 'files/review', 'REV' . $request->id);
        }

        $comment = new Comments();
        $comment->product_id = $request->id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->number = $request->number;
        $comment->rating = $request->rating;
        $comment->comment = $request->comment;
        $comment->image = Photo::$name;
        $comment->save();

        return back()->with('succ', 'Review added succsessfully');
    }
}
