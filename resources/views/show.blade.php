@extends('layout.master')

@section('content')
  <div class="row mb-6">
    <div class="col-md-12">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">Design</strong>
          <h5 class="mb-0">{{ $product->title }}</h5>
          <div class="mb-1 text-muted">{{ $product->created_at->format('d/m/Y') }}</div>
          <p class="mb-auto">{{ $product->description }}</p>
          <strong class="mb-auto">{{ $product->getPrice() }} /Jour</strong>
           <form action ="{{ route('cart.store') }}" method ="POST">
           @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        
                <button type="submit" class="btn btn-dark">Ajouter au panier </button>
           </form>        
        </div>
        <div class="col-auto d-none d-lg-block"><img src="{{ $product->image }}" alt=""></div>
    </div>
  </div>
     <h5> Commentaire du produit </h5>
     @forelse($product->comments as $comment)
      <div class="card mb-2">
        <div class="card-body">
          {{ $comment->content }}
          {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
        </div>
      </div>
      @empty
        <div class="alert alert-info">Aucun Commentaire </div>
      @endforelse
      <form action="{{ route('comments.store',['product'=>$product] ) }}" method="POST" class="mt-2">
      @csrf
      <div class="form-group">
      <br>
      <label for="content">Votre commentaire</label>
      <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="contant" rows="5"></textarea>
      @error('content')
      <div class="invalid-feedback">{{ $errors->first('content') }} </div>
      @enderror
      </div>
      
      <button type="submit" class="btn btn-primary">Soumettre le commentaire</button>
      </form>
      
@endsection