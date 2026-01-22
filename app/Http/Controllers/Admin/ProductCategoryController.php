<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index(){
        //select * from product_category_new order by created_at desc
        $datas = DB::table('product_category_new')
        ->orderBy('created_at', 'desc')->get();

        return view('admin.pages.product_category.index', ['datas' => $datas]);
    }

    public function destroy(string $id){
        $data = DB::table('product_category_new')->where('id', $id)->delete();

        $message = $data ? 'Delete success' : 'Delete failed';

        //Flash message (session)
        return redirect()->route('admin.product_category.index')->with('message',  $message );
    }

    public function update(string $id, Request $request){
        //Validate data
        $request->validate([
            'name' => ['required', 'min:3', 'max:10'],
            'slug' => 'required|min:3|max:10',
            'status' => ['required']
        ], [
            'name.required' => 'Name is required',
            'slug.required' => 'Slug buoc phai nhap.'
        ]);

        $check = DB::table('product_category_new')->where('id', $id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status
        ]);

        $message = $check ? 'Update success' : 'Update failed';

        //Flash message (session)
        return redirect()->route('admin.product_category.index')->with('message',  $message );
    }

    public function detail(string $id){
        $data = DB::table('product_category_new')->find($id);
        return view('admin.pages.product_category.detail', ['data' => $data]);
    }
    
    public function create(){
        return view('admin.pages.product_category.create');
    }

    public function store(Request $request){
        //Validate data
        $request->validate([
            'name' => ['required', 'min:3', 'max:10', 'unique:product_category_new'],
            'slug' => 'required|min:3|max:10',
            'status' => ['required']
        ], [
            'name.required' => 'Name is required',
            'slug.required' => 'Slug buoc phai nhap.'
        ]);

        //Fresh data
        $result = DB::table('product_category_new')->insert([
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

        $check = DB::table('product_category_new')->where('slug', '=', $slug)->count();

        if($check){
            $slug = Str::slug($request->slug.' '.uniqid());
        }

        return response()->json(['slug' => $slug]);
    }
}
