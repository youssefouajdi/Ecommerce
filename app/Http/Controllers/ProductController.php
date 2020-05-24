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
    public function search(){
        request()->validate([
            'q'=>'required|min:3'
        ]);
        $q= request()->input('q');
        $products=Prod::where('title','like',"%$q%")
                ->orWhere('description','like',"%$q%")
                ->paginate(6);
        return view('search')->with('products',$products);
    }
}