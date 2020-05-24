@extends('layout.master')
@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<form method="POST" action="{{ route('partenaire.store') }}" id="annonce-form" enctype="multipart/form-data">
@csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Titre</label>
      <input type="texte" class="form-control" name="titre_id" placeholder="Titre">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">soustitre</label>
      <input type="text" class="form-control" name="soustitre" placeholder="Soustitre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">description</label>
    <input type="text" class="form-control" name="description" placeholder="description">
  </div>
  <div class="form-group">
  <label for="inputState">Categorie</label>
      <select id="categorie" class="form-control">
      @foreach(App\Category::all() as $category)
        <option>{{ $category->name }}</option>
        @endforeach
      </select>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="prix">Prix</label>
      <input type="text" class="form-control" name="prix">
    </div>
    <div class="form-group col-md-5">
      <label for="image">image</label>
      <input type="file" placeholder="" id="image" name="image" class="form-control" >
    </div>
  </div>
  <button type="submit" id="submit" class="btn btn-primary">Soumettre l annonce</button>
</form>
@endsection

