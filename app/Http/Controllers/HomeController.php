<?php

namespace App\Http\Controllers;
use App\Prod;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Prod::inRandomOrder()->take(6)->get();
        return view('index')->with('products',$products);
    }
}
