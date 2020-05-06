<?php

namespace App\Http\Controllers;
use App\Prod;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Prod::inRandomOrder()->take(6)->get();
        return view('index')->with('products',$products);
    }
    public function show($slug)
    {
        $product=Prod::where('slug',$slug)->firstOrFail();
        return view('show')->with('product',$product);
    }
}