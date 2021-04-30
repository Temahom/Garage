
@extends('layout.index')
@php
    $liste_produits = App\Models\Produit::all();
@endphp

@section('content')

 
@endsection