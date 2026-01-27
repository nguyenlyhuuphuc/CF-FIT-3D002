<?php

use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('client.layout.master');
    return view('welcome');
});

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

Route::get('admin/product_category/index',[ProductCategoryController::class, 'index'])->name('admin.product_category.index');

Route::get('admin/product_category/create', [ProductCategoryController::class, 'create'])->name('admin.product_category.create');

Route::post('admin/product_category/save',[ProductCategoryController::class, 'store'])->name('admin.product-category.store');

Route::post('admin/product_category/update/{id}',[ProductCategoryController::class, 'update'])->name('admin.product-category.update');

Route::get('admin/product_category/detail/{id}',[ProductCategoryController::class, 'detail'])->name('admin.product-category.detail');

Route::post('admin/product_category/destroy/{id}',[ProductCategoryController::class, 'destroy'])->name('admin.product-category.destroy');

Route::post('admin/product_category/make_slug', [ProductCategoryController::class, 'makeSlug'])->name('admin.product-category.make-slug');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
