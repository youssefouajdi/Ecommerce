@extends('layout.master')
@section('content')
<form method="POST" action="{{ route('noter.update') }}" id="annonce-form" enctype="multipart/form-data">
@csrf
  <div class="form-row">
    <div class="form-group col-md-6">
    <input type="hidden" id="custId" name="custId" value=5>
      <label for="inputEmail4">Votre note sur le produit:</label>
      <input type="number" placeholder="1.00" step="0.01" min="0" max="10" name="note" required> 
    </div>
    
  <br>
  <button type="submit" id="submit" class="btn btn-primary">Soumettre votre note</button>
</form>
@endsection