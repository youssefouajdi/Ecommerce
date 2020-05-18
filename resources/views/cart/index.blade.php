@extends('layout.master')
@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<script>


    </script>


    @if(Cart::count()>0)
    <div class="px-4 px-lg-0">


<div class="pb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col" class="border-0 bg-light">
                  <div class="p-2 px-3 text-uppercase">Produit</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">Prix</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">Debut Reservation</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">Fin Reservation</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">Jour</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">Supprimer</div>
                </th>
              </tr>
            </thead>
            <tbody>
             @foreach(Cart::content() as $product)           
             <tr>
                <th scope="row" class="border-0">
                  <div class="p-2">
                    <img src="{{ $product->model->image }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                    <div class="ml-3 d-inline-block align-middle">
                      <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">{{ $product->model->title }}</a></h5><span class="text-muted font-weight-normal font-italic d-block">Category: Watches</span>
                    </div>
                  </div>
                </th>
                <td class="border-0 align-middle"><strong>{{ getPrice($product->subtotal()) }}</strong></td>
                <td class="border-0 align-middle"><strong>  <input type="date" id="datedebut" name="Datdebut" onchange="showData()"></strong></td>
                <td class="border-0 align-middle"><strong>  <input type="date" id="datefin" name="Datfin" onchange="showData()"></strong></td>
                <td class="border-0 align-middle" ><strong>

                <select name="qty" id="qty"  data-id="{{ $product->rowId }}" class="custom-select" >
                <?php 
                $a=$product->qty; ?>
                    @for($i=1 ; $i<100 ; $i++)
                      <option id ="qty1" value="{{ $i }}" {{ $i==$a ? 'selected' : '' }} >{{ $i }}</option>
                    @endfor
                </select>
                </strong></td>
                <td class="border-0 align-middle">
                    <form action ="{{ route('cart.destroy', $product->rowId )}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-dark"><i class="fa fa-trash"></i></a>
                    </form>
                </td>
              </tr>
             @endforeach
            </tbody>
          </table>
        </div>
        <!-- End -->
      </div>
    </div>

    <div class="row py-5 p-4 bg-white rounded shadow-sm">
      <div class="col-lg-6">
        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">code Coupon</div>
        <div class="p-4">
          <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
          <div class="input-group mb-4 border rounded-pill p-2">
            <input type="text" placeholder="Appliquer Coupon" aria-describedby="button-addon4" class="form-control border-0">
            <div class="input-group-append border-0">
              <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Reduction</button>
            </div>
          </div>
        </div>
        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Commentaire sur produit</div>
        <div class="p-4">
          <p class="font-italic mb-4">Information supplementaire sur le produit</p>
          <textarea name="" cols="30" rows="2" class="form-control"></textarea>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Detail de la commande </div>
        <div class="p-4">
          <p class="font-italic mb-4">Facturation total de votre panier .</p>
          <ul class="list-unstyled mb-4">
            <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Prix</strong><strong>{{ getPrice(Cart::subtotal()) }}</strong></li>
            <!--<li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li>-->
            <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>{{ getPrice(Cart::tax()) }}</strong></li>
            <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
              <h5 class="font-weight-bold">{{ getPrice(Cart::total()) }}</h5>
            </li>
          </ul><a href="{{ route('checkout.index') }}" class="btn btn-dark rounded-pill py-2 btn-block">Valider le payement</a>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
    @else
    <div class="col-md-12"><p>votre panier est vide.</p> </div>
    @endif
    @endsection
    @section('extra-js')
    <script>
    function showData(){
 
 var number=document.getElementById("datedebut").value;
 var number1=document.getElementById("datefin").value;   
 if((number !== "") && (number1 !== "")){
   
   var date_diff_indays = function(date1, date2) {
     dt1 = new Date(date1);
     dt2 = new Date(date2);
     return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
   }
   
   if(date_diff_indays(number, number1)>0){
     let element = document.getElementById("qty");
     element.value  =date_diff_indays(number, number1);
     var selects= document.querySelectorAll('#qty');
      Array.from(selects).forEach((element)=>{
        console.log(element);
        element.addEventListener('change',function(){
          var rowId=this.getAttribute('data-id');
          var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          var url=`/panier/${rowId}`;
          console.log(url);
          fetch(
            url,{
                        headers:{
                            "Content-Type": "application /json",
                            "Accept":"application/json, text-plain ,*/*",
                            "X-Requested-With":"XMLHttpRequest",
                            "X-CSRF-TOKEN":token
                        },
                        method: "PATCH",
              body:JSON.stringify({
                qty: this.value
              })
            }
          ).then((data)=>{
            console.log(data);
            location.reload();
          }).catch((error)=>{
            console.log(error);
          })
        });
      });
    }else{
       element.value = valueToSelect ="0";
   
   }
   }

      
    }
    </script>
@endsection