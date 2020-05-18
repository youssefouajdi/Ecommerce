<?php

namespace App\Http\Controllers;
use App\Prod;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index(){
        if(request()->categorie){
            $products=Prod::with('categories')->whereHas('categories',function
            ($query){
               $query->where('slug',request()->categorie);
           })->paginate(6);
        }else{
        $products = Prod::with('categories')->paginate(6);
    }
        return view('index')->with('products',$products);
    }
    public function show($slug)
    {
        $product=Prod::where('slug',$slug)->firstOrFail();
        return view('show')->with('product',$product);
    }
}