<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index(Request $request){       
        //Query Builder 
        // $datas = DB::table('product_category')
        // ->orderBy('id', 'desc')
        // ->paginate( config('my-config.item_per_page'));

        //Eloquent
        $datas = ProductCategory::orderBy('id','desc')->paginate(config('my-config.item_per_page'));

        return view('admin.pages.product_category.index', ['datas' => $datas]);
    }

    public function destroy(ProductCategory $productCategory){
        //Query Builder
        // $data = DB::table('product_category')->where('id', $id)->delete();
        //Eloquent
        // $data = ProductCategory::find($id)->delete();
        $data = $productCategory->delete();

        $message = $data ? 'Delete success' : 'Delete failed';

        //Flash message (session)
        return redirect()->route('admin.product_category.index')->with('message',  $message );
    }

    public function update(string $id, Request $request){
        //Validate data
        $request->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'slug' => 'required|min:3|max:100',
            'status' => ['required']
        ], [
            'name.required' => 'Name is required',
            'slug.required' => 'Slug buoc phai nhap.'
        ]);

        //Query Builder
        // $check = DB::table('product_category')->where('id', $id)->update([
        //     'name' => $request->name,
        //     'slug' => $request->slug,
        //     'status' => $request->status
        // ]);

        //Eloquent
        $check = ProductCategory::find($id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status
        ]);

        $message = $check ? 'Update success' : 'Update failed';

        //Flash message (session)
        return redirect()->route('admin.product_category.index')->with('message',  $message );
    }

    public function detail(ProductCategory $productCategory){
        //Query Builder
        // $data = DB::table('product_category')->find($id);
        //Eloquent
        // $data = ProductCategory::findOrFail($productCategory);
        return view('admin.pages.product_category.detail', ['data' => $productCategory]);
    }
    
    public function create(){
        return view('admin.pages.product_category.create');
    }

    public function store(Request $request){
        //Validate data
        $request->validate([
            'name' => ['required', 'min:3', 'max:10', 'unique:product_category'],
            'slug' => 'required|min:3|max:10',
            'status' => ['required']
        ], [
            'name.required' => 'Name is required',
            'slug.required' => 'Slug buoc phai nhap.'
        ]);

        //Fresh data
        //Query Builder
        // $result = DB::table('product_category')->insert([
        //     'name' => $request->name,
        //     'slug' => $request->slug,
        //     'status' => $request->status
        // ]);

        //Eloquent
        // $productCategory = new ProductCategory();
        // $productCategory->name = $request->name;
        // $productCategory->slug = $request->slug;
        // $productCategory->status = $request->status;
        // $result = $productCategory->save(); //Insert new record

        $result = ProductCategory::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status
        ]);

        $message = $result ? 'Add success' : 'Add failed';

        //Flash message (session)
        return redirect()->route('admin.product_category.index')->with('message',  $message );
    }

    public function makeSlug(Request $request){
        $slug = Str::slug($request->slug);

        //Query Builder
        // $check = DB::table('product_category')->where('slug', '=', $slug)->count();
        //Eloquent
        $check = ProductCategory::where('slug',$slug)->count();

        if($check){
            $slug = Str::slug($request->slug.' '.uniqid());
        }

        return response()->json(['slug' => $slug]);
    }
}
