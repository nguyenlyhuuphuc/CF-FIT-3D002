<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function (){
    return view('test.abc.xyz.test');
});

Route::get('a/b/c', function (){
    echo '<h1>C</h1>';
});

Route::get('product/detail/{id}/product_category/{categoryId?}', function(string|int $id, string|int $productCategoryId = 37){
    echo "product $id category : $productCategoryId";
});


Route::get('product_category/detail/{id}', function(string|int $id){
    echo "category : $id";
});


Route::get('product_category/detail/18', function(){
    echo "category : 18+++++++";
});

Route::get('students', [StudentController::class, 'index']);