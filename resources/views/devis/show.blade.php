@extends('layout.index')
@php
setlocale(LC_TIME, "fr_FR", "French");
@endphp
@section('titre')
<h1>Devis N°:D00-{{$devi->id}}</h1>
@endsection
@section('content')

<div class="card-body">
    
    <h4><strong>Date :</strong> {{strftime("%A %d %B %Y", strtotime($devi->created_at))}}</h4>
    <h5><strong>Coût de Réparation:</strong> {{number_format($devi->cout,0, ",", " " )}} <sup>F CFA</sup></h5>
    <a href="/devis/" class="btn btn-success">&#8592; Retour</a>
</div>
@endsection