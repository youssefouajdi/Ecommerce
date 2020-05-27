@extends('layout.master')
@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection
@section('content')
@foreach($products as $product)
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <h5 class="mb-0">Produit demande :{{ $product->title_prod }}</h5>
          <div ><h5 class="mb-0">Demande de :{{ $product->user_name}}</h5></div>
           <h5>Le jour de reservation :{{ $product->datedebut }}</h5>
          <strong class="mb-auto">Nombre de Jour{{ $product->jour }}</strong>
          <p class="mb-auto" id="start" onstart="showData()" >Creer a :{{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</p>
          <?php 
          $c= $product->etat 
          ?>
          <form id="formABC" action ="{{ route('notif.delete',[ 'id' => $product->id ] ) }}"method="POST">
          @csrf
          @method('delete')
          
          @if( $c==2 || $c ==1)
                <button id="btnSubmit" class="btn btn-danger" disabled>refuser l annonce </button>
            @else
                <button id="btnSubmit" class="btn btn-danger" >refuser l annonce </button>
            @endif
          </form>
          <form id="formABCD" action ="{{ route('notif.update',[ 'id' => $product->id ] ) }} " method="POST">
          @csrf
          @method('put')
          @if($c ==2 || $c ==1)
              <button id="btnTest" class="btn btn-success" disabled>Accepter l annonce </button>
              @else
              <button id="btnTest" class="btn btn-success" >Accepter l annonce </button>
              @endif
          </form>
        </div>
      </div>
    </div>
    @endforeach

@endsection
 @section('extra-test')
 <script>
    $(document).ready(function () {
        $("#formABC").submit(function (e) {
            e.preventDefault();
            var URL = $("#formABC").attr("action");
            fetch(URL, {
       method: 'delete',
       body: new FormData(document.getElementById('formABC'))
     }).then(function(response){
        $("#btnSubmit").attr("disabled", true);
            $("#btnTest").attr("disabled", true);
       })catch(function(error){
            console.log("not ok");
         });
            
        });
        $("#formABCD").submit(function (e) {
            e.preventDefault();
            var URL = $("#formABCD").attr("action");
            fetch(URL, {
       method: 'delete',
       body: new FormData(document.getElementById('formABCD'))
     }).then(function(response){
        $("#btnSubmit").attr("disabled", true);
            $("#btnTest").attr("disabled", true);
       })catch(function(error){
            console.log("not ok");
         });
            
        });
    });
</script>
 @endsection