<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\User_product;
use App\Prod;
use App\Auth;
use Carbon\Carbon;
class NotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(){
        $products=DB::select('select * from user_commands  where prod_id IN ( 
            select prod_id from user_products where user_id = '.Auth()->user()->id.')');
           
        return view('partenaire.notif')->with('products',$products);
    }
    public function test(Request $request)
    {
        DB::table('user_commands')->insert([
            ['user_command' => Auth()->user()->id, 'prod_id' => $request->input('custId')
            ,'jour'=> $request->input('qty') ,'datedebut'=>$request->input('Datdebut'),
            'user_name'=>Auth()->user()->name ,'title_prod'=> $request->input('titleprod'),'created_at'=>Carbon::now()->toDateTimeString()]
        ]);
        
        $success="Le produit a ete envoye avec succes";
        return redirect()->back()->with(compact('success'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        DB::update('update user_commands set etat = ? where id = ?',[1,$id]);
        $success="Vous avez accepter le produit pour qu il soit reserver";
        return redirect()->back()->with(compact('success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::update('update user_commands set etat = ? where id = ?',[2,$id]);
        $error="Vous avez refusez le produit pour qu il soit reserver ";
        return redirect()->back()->with(compact('error'));
    }
    public static function count()
    {
       
        $products=DB::select('select count(id) from user_commands  where prod_id IN ( 
            select prod_id from user_products where user_id = '.Auth()->user()->id.')');
            //return view('layout.master')->with('products',$products);
    }
}
