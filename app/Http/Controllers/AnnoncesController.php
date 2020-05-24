<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User; 
use App\Prod;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;



class AnnoncesController extends Controller
{

    public function ajoutannonce()
    {
        return view('partenaire.annonce');
    }

    public function store(Request $request)
    {
        $ad = new Prod();
        $ad->title=$request->input('titre_id');
        $ad->slug=$request->input('soustitre');
        $ad->subtitle=$request->input('soustitre');
        $ad->description=$request->input('description') ;
        $ad->price = $request->input('prix');
        $ad->image="http://www.placeholder.com/250x250";
        
  
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/ad/',$filename);
            $ad->image=$filename;
        $ad->save();
        return view('partenaire.annonce');
    }

    
}

