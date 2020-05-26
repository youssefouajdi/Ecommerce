@extends('layout.master')
@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
@foreach($products as $product)

    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <h5 class="mb-0">{{ $product->title }}</h5>
          <div class="mb-1 text-muted">{{ $product->created_at}}</div>
          <p class="mb-auto">{{ $product->subtitle }}</p>
          <strong class="mb-auto">{{ $product->price }} /Jour</strong>
          <form action="{{ route('partenaire.delete',[ 'id' => $product->id ] ) }}" method="POST">
          @csrf
          @method('delete')
              <button class="btn btn-danger">Supprimer l annonce</a></button>
          </form>
        </div>
        <div class="col-auto d-none d-lg-block">
        <img src= "{{URL::asset('/uploads/ad/'.$product->image)}}" alt="">
        </div>
      </div>
    </div>
 
    @endforeach
@endsection