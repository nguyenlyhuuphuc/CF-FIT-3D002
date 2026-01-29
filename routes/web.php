<?php

use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckIsAdmin;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Route;

Route::get('7up', function(){
    return '7 Up';
});
Route::get('hennessy', function(){
    return 'hennessy';
})->middleware('auth');

Route::get('/', function () {
    // return view('client.layout.master');
    return view('welcome');
})->name('home');

Route::get('home', function () {
    return view('client.pages.home');
});

Route::get('cart', function () {
    return view('client.pages.cart');
});

Route::get('contact', function () {
    return view('client.pages.contact');
});

Route::get('checkout', function () {
    return view('client.pages.checkout');
});

Route::get('product_list', function () {
    return view('client.pages.product_list');
});

Route::get('product_detail', function () {
    return view('client.pages.product_detail');
});

Route::get('admin/home', function(){
    return view('admin.layout.master');
});

Route::prefix('admin')
->name('admin.')
->group(function(){
    Route::resource('product', ProductController::class);
});


Route::controller(ProductCategoryController::class)
->prefix('admin/product_category')
->middleware(CheckIsAdmin::class)
->name('admin.product_category.')->group(function(){
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('save', 'store')->name('store');
    Route::post('update/{id}', 'update')->name('update');
    Route::get('detail/{id}', 'detail')->name('detail');
    Route::post('destroy/{id}', 'destroy')->name('destroy');
    Route::post('make_slug', 'makeSlug')->name('make-slug');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
