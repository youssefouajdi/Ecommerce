@extends('layout.master')
@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
<h5 class="mb-0">Mail envoyé!</h5>
@endsection