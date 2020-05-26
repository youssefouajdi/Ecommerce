<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\User_product;
use App\Prod;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;



class AnnoncesController extends Controller
{
    public function index(){
        $c=Auth()->user()->id;
        $users=DB::select('select prod_id from user_products where user_id = ?', [$c]);
        $a=$users[0]->prod_id;
        $products=DB::select('select * from prods where id = ?', [$c]);
        return view('partenaire.list')->with('products',$products);
    }
    public function ajoutannonce()
    {
        return view('partenaire.annonce');
    }

    public function store(Request $request)
    {
        if ( DB::select('select id from prods where title = ?', [$request->input('titre_id')]))
        {
            $error="Le produit existe deja";
        return redirect()->back()->with(compact('error'));
        }else{
            if($request->input('datefin')<$request->input('datedebut') ){
                $error="champ mal rempli";
        return redirect()->back()->with(compact('error'));
            }else{
            $ad = new Prod();
            $ad->title=$request->input('titre_id');
            $ad->slug=$request->input('soustitre');
            $ad->subtitle=$request->input('soustitre');
            $ad->description=$request->input('description') ;
            $ad->price = $request->input('prix');
                $file=$request->file('image');
                $extension=$file->getClientOriginalExtension();
                $filename=time().'.'.$extension;
                $file->move('uploads/ad/',$filename);
                $ad->image=$filename;
            $ad->save();
        $f = DB::select('select id from prods where title = ?', [$request->input('titre_id')]);
        $f1= new User_product();
        $f1->prod_id=$f[0]->id;
        $f1->user_id=Auth()->user()->id;
        $f1->debut_offre=$request->input('datedebut');
        $f1->fin_offre=$request->input('datefin');
        $f1->save();
        $success="Le produit a ete ajouter avec succees vous pouvez le consultez sur votre liste de produit";
        return redirect()->back()->with(compact('success'));
            }
        }
    }
    public function destroy($id)
    {
        $blog = Prod::findOrFail($id);
        $blog->delete();
        return redirect('/annonce');
    }

    
}

