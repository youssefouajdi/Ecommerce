<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use App\Order;
use DateTime;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function thankyou(){
        return Session::has('success')?view('checkout.thankyou'):redirect()->route('index');
    }
    public function index()
    {
        if (Cart::count()<1){
            return redirect()->route('index');
        }
        
        Stripe::setApiKey('sk_test_0uhuzPlVfTCx3cOCkDv42Qvv00TyHFDi4j');
        $intent=PaymentIntent::create([
            'amount'=>round(Cart::total()),
            'currency'=>'eur',
            
        ]);
        $clientSecret= Arr::get($intent,'client_secret');
        return view('checkout.index',
    [
        'clientSecret'=>$clientSecret
    ]);
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
        $data =$request->json()->all();
        $order =new Order();
        $order->payment_intent_id=$data['paymentIntent']['id'];
        $order->amount=$data['paymentIntent']['amount'];
        $order->payment_created_at=(new DateTime())->setTimestamp($data['paymentIntent']['created'])->format('Y-m-d H:i:s');
        $products=[];
        $i=0;
        foreach(Cart::content() as $product){
            $products['product_'.$i][]=$product->model->title;
            $products['product_'.$i][]=$product->model->price;
            $products['product_'.$i][]=$product->qty;
            $i++;
        }
        $order->products=serialize($products);
        $order->user_id=Auth()->user()->id;
    $order->save();
        if($data['paymentIntent']['status']==='succeeded'){
            Cart::destroy();
            Session::flash('success','commande traite avec succes');
            return response()->json(['success'=>'Payement Intent succeeded']);
        }else{
            return response()->json(['error'=>'Payement Intent not  succeeded']);
        }
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
        //
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
        //
    }
}
