<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Prod;
use DB;
use App\Coupon;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer;
class CartController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
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
        $produit=Prod::find($request->product_id);
        Cart::add($produit->id,$produit->title,1,$produit->price)
            ->associate('App\Prod');
            $success="Le produit a bien ete ajoute";
        return redirect()->route('index')->with(compact('success'));
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
    public function sendmail($rowId){ 
        $c=Auth()->user()->id;
        $destinataire=DB::select('select email from users where id = ? ', [$c]);
        foreach ($destinataire as $d) {
            $adr = $d->email;
        }
        //$adr = (string)$destinataire[0];
        //$client=User::find($user_id);
        $mail = new PHPMailer\PHPMailer(); 
        $mail->isSMTP();
        $mail->SMTPAuth = 'true';
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML();
        $mail->Username = 'projet.p2p.location2020@gmail.com';
        $mail->Password = 'projetlocation2020';
        $mail->SetFrom('no-reply@location.com');
        $mail->Subject = 'Evaluation de votre exp�rience';
        $mail->Body = 'localhost:8000/noter/product'.$rowId;
        $mail->AddAddress($adr);
        
        $mail->Send();
        return back()->with('success','Un email vous a été envoyé');
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
    public function update(Request $request, $rowId)
    {
        $data=$request->json()->all();
        Cart::update($rowId,$data['qty']);
        Session::flash('success','La quantite du produit est passee a '.$data['qty'].'.');
        return  response()->json(['success'=>'Cart quantity has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        return back()->with('success','Le produit a ete supprime.');
    }

    public function storeCoupon(Request $request)
    {
        $code=$request->get('code');
        $coupon=Coupon::where('code',$code)->first();
        if(!$coupon){
            return redirect()->back()->with('error','le coupon est invalide.');
        }
        $request->session()->put('coupon',[
            'code'=>$coupon->code,
            'remise'=>$coupon->discount(Cart::subtotal())
        ]);
        return redirect()->back()->with('success','le coupon est valide.');
    }
}
