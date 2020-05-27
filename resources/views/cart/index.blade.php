@extends('layout.master')
@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
<script>
function showData(){
 var date=document.getElementById("datedebut").value;
 var number1=document.getElementById("qty").options[document.getElementById("qty").selectedIndex].value;   
 if((date !== "") && (number1 !== "")){
  console.log(number1);
  var someDate = new Date(date);
  console.log(parseInt(someDate.getDate()) + parseInt(number1))
  someDate.setDate(parseInt(someDate.getDate()) + parseInt(number1));
  var dd = someDate.getDate();
  var mm = someDate.getMonth() + 1;
  var y = someDate.getFullYear();
  console.log(dd+"-" + mm + "-" + y);
  var currentMonth;
  var currentDay;
  if (mm < 10){
    currentMonth = '0' + mm; 
  }
  else{
    currentMonth = mm;
  }
  if (dd < 10){
    currentDay = '0' + dd; 
  }
  else{
    currentDay = dd;
  }
  var someFormattedDate = y + '-'+ currentMonth + '-'+ currentDay;
  document.getElementById("datefin").value = someFormattedDate;
    }
   }
    </script>
 @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
@section('content')
    @if(Cart::count()>0)
    <div class="px-4 px-lg-0">


<div class="pb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 p-3 bg-white rounded shadow-sm mb-5">
        <div class="table-responsive  ">
          <table class="table">
            <thead>
              <tr>
                <th scope="col" class="border-0 bg-light">
                  <div class="p-2 px-3 text-uppercase">Produit</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 px-3 text-uppercase">Prix</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 px-3 text-uppercase">Jour</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">Debut Reservation</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">Fin Reservation</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="p-2 px-3 text-uppercase">Reservation</div>
                </th>
                
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">Supp.</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="p-2  text-uppercase">Etat</div>
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
                <form action ="{{ route('notif.test') }}" method="POST">
                        @csrf
                        <input type="hidden" id="custId" name="custId" value="{{ $product->id }}">
                        <input type="hidden" id="titleprod" name="titleprod" value="{{ $product->model->title}}">
                <td class="border-0 align-middle" ><strong>

                <select name="qty" id="qty"  data-id="{{ $product->rowId }}" class="custom-select" >
                
                <?php 
                $a=$product->qty; ?>
                    @for($i=1 ; $i<100 ; $i++)
                      <option id ="qty1" value="{{ $i }}" {{ $i==$a ? 'selected' : '' }} >{{ $i }}</option>
                    @endfor
                </select>
                </strong></td>
                
                    <td class="border-0 align-middle"><strong>  <input type="date" id="datedebut" name="Datdebut" onchange="showData()"></strong></td>
                    <td class="border-0 align-middle"><strong>  <input type="date" id="datefin" name="Datfin" disabled></strong></td>
                    <td class="border-0 align-middle"><button type="submit" class="text-dark"><span>Envoyez</span></td>
                </form>
                <td class="border-0 align-middle">
                    <form action ="{{ route('cart.destroy', $product->rowId )}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-dark" ><i class="fa fa-trash"></i></a>
                    </form>
                </td>
                <td class="border-0 align-middle" id="buttonID">
                

                </td>
              </tr>
             @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="row py-5 p-4 bg-white rounded shadow-sm">
      <div class="col-lg-6">
        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">code Coupon</div>
        <div class="p-4">
          <p class="font-italic mb-4">Code coupon</p>
          <div class="input-group mb-4 border rounded-pill p-2">
            <input type="text" placeholder="Appliquer Coupon" aria-describedby="button-addon4" class="form-control border-0">
            <div class="input-group-append border-0">
              <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Reduction</button>
            </div>
          </div>
        </div>
        <!--<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Commentaire sur produit</div>
        <div class="p-4">
          <p class="font-italic mb-4">Information supplementaire sur le produit</p>
          <textarea name="" cols="30" rows="2" class="form-control"></textarea>
        </div>-->
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
let element = document.getElementById("qty");
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
            showData();
          }).catch((error)=>{
            console.log(error);
          })
        });
      });

    </script>
@endsection
@section('extra-test')
<script src="jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$('#buttonID').click(function(e) {  
        e.preventDefault();
        var param1 = $(this).data("param1")
        var param2 = $(this).data("param2")
        $.ajax({
           url: "/routeNames",
           type: "GET",
           data: { data1: param1, data2: param2 }, 
           success: function(response) {
           console.log(response);  
        }
   });
});
</script>