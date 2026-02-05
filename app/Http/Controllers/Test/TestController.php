<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Mail\EmailProductAdmin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function sendEmailProduct(){
        $products = Product::where('status', 1)
        ->orderBy('id','desc')
        ->limit(5)
        ->offset(0)
        ->get();

        Mail::to('admin@gmail.com')->send(new EmailProductAdmin($products));
    }
}
