<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Query Builder //Eloquent
        // $datas = DB::table('product')
        // ->select(['product.*', 'product_category.name as product_category_name'])
        // ->leftJoin('product_category', 'product.product_category_id','=', 'product_category.id')
        // ->orderBy('product.id', 'desc')
        // ->paginate(1000);

        $datas = Product::orderBy('id', 'desc')
        ->with('productCategory')
        ->paginate(1000);

        return view('admin.pages.product.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Query Builder
        // $productCategories = DB::table('product_category')
        // ->where('status', 1)
        // ->orderBy('id', 'desc')
        // ->get();

        //Eloquent
        $productCategories = ProductCategory::where('status',1)
        ->orderBy('id','desc')
        ->get();

        return view('admin.pages.product.create', ['productCategories' => $productCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'description' => 'required',
            'status'  => 'required',
            'product_category_id' => 'required',
            'image' => 'required|image',
        ]);

        $imageName = $request->file('image')->getClientOriginalName();
        $nameOrigin = sprintf('%s-%s', 
            pathinfo($imageName, PATHINFO_FILENAME),
            uniqid()
        );

        $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $nameFinal = sprintf('%s.%s', $nameOrigin, $extension);
        $request->file('image')->move(public_path('images'), $nameFinal);

        //Query Builder
        // $result = DB::table('product')->insert([
        //     'name' => $request->name,
        //     'image' => $nameFinal,
        //     'price' => $request->price,
        //     'sku' => sprintf('sku-%s', uniqid()),
        //     'slug'=> Str::slug($request->name),
        //     'qty' => $request->qty,
        //     'description' => $request->description,
        //     'status' => $request->status,
        //     'product_category_id' => $request->product_category_id,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        //Eloquent
        $result = Product::create([
            'name' => $request->name,
            'image' => $nameFinal,
            'price' => $request->price,
            'sku' => sprintf('sku-%s', uniqid()),
            'slug'=> Str::slug($request->name),
            'qty' => $request->qty,
            'description' => $request->description,
            'status' => $request->status,
            'product_category_id' => $request->product_category_id
        ]);

        $message = $result ? 'Add success' : 'Add failed';

        //Flash message (session)
        return redirect()->route('admin.product.index')->with('message',  $message );
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //Query Builder
        // $productCategories = DB::table('product_category')
        // ->where('status', 1)
        // ->orderBy('id', 'desc')
        // ->get();

        //Eloquent
        $productCategories = ProductCategory::where('status',1)
        ->orderBy('id','desc')
        ->get();

        return view('admin.pages.product.detail', ['product' => $product, 'productCategories' => $productCategories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
         $request->validate([
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'description' => 'required',
            'status'  => 'required',
            'product_category_id' => 'required',
            'image' => 'image',
        ]);

        if($request->hasFile('image')){
            $imageName = $request->file('image')->getClientOriginalName();
            $nameOrigin = sprintf('%s-%s', 
                pathinfo($imageName, PATHINFO_FILENAME),
                uniqid()
            );

            $extension = pathinfo($imageName, PATHINFO_EXTENSION);
            $nameFinal = sprintf('%s.%s', $nameOrigin, $extension);
            $request->file('image')->move(public_path('images'), $nameFinal);
        }else{
            // $product = DB::table('product')->find($id);
            $nameFinal = $product->image;
        }
        //Query Builder
        // $result = DB::table('product')->where('id', $id)->update([
        //     'name' => $request->name,
        //     'image' => $nameFinal,
        //     'price' => $request->price,
        //     'sku' => sprintf('sku-%s', uniqid()),
        //     'slug'=> Str::slug($request->name),
        //     'qty' => $request->qty,
        //     'description' => $request->description,
        //     'status' => $request->status,
        //     'product_category_id' => $request->product_category_id,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        //Eloquent
        $result = $product->update([
            'name' => $request->name,
            'image' => $nameFinal,
            'price' => $request->price,
            'sku' => sprintf('sku-%s', uniqid()),
            'slug'=> Str::slug($request->name),
            'qty' => $request->qty,
            'description' => $request->description,
            'status' => $request->status,
            'product_category_id' => $request->product_category_id
        ]);

        $message = $result ? 'Update success' : 'Update failed';

        //Flash message (session)
        return redirect()->route('admin.product.index')->with('message',  $message );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $data = $product->delete();

        $message = $data ? 'Delete success' : 'Delete failed';

        //Flash message (session)
        return redirect()->route('admin.product.index')->with('message',  $message );
    }
}
