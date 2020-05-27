@extends('layout.master')
@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')
@foreach($products as $product)
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <h5 class="mb-0">{{ $product->title_prod }}</h5>
          <div class="mb-1 text-muted">{{ $product->user_name}}</div>
          <p class="mb-auto">{{ $product->datedebut }}</p>
          <strong class="mb-auto">{{ $product->jour }}</strong>
          <p class="mb-auto" id="start" onstart="showData()" >Creer a  {{ $product->created_at }}</p>
          <p class="mb-auto" id="end" >expire a  </p>
          <form action ="{{ route('notif.delete',[ 'id' => $product->id ] ) }}"method="POST">
          @csrf
          @method('delete')
                <button class="btn btn-danger">refuser l annonce </button>
          </form>
          <form action ="{{ route('notif.update',[ 'id' => $product->id ] ) }} " method="POST">
          @csrf
          @method('put')
              <button class="btn btn-success">Accepter l annonce </button>
          </form>
        </div>
      </div>
    </div>
    @endforeach
@endsection
    @section('extra-js')
    <script>
        var date=document.getElementById("start").value;
        var someDate = new Date(date);
        console.log(someDate.getTime());
        var actuel=new Date();
        console.log(someDate);
        console.log(actuel.getTime());
        
    </script>


    @endsection