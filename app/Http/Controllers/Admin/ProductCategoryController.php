<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    public function index(){
        //select * from product_category_new order by created_at desc
        $datas = DB::table('product_category_new')
        ->orderBy('created_at', 'desc')->get();

        return view('admin.pages.product_category.index', ['datas' => $datas]);
    }

    public function detail(string $id){
        dd($id);
    }

    public function create(){
        return view('admin.pages.product_category.create');
    }

    public function store(Request $request){
        //Validate data
        $request->validate([
            'name' => ['required', 'min:3', 'max:10'],
            // 'slug' => ['required', 'min:3', 'max:10'],
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

        return redirect()->route('admin.product_category.index');
    }
}
