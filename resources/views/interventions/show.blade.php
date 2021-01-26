@extends('layout.index')

@section('content')
    <div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white ">
        <div class="col-md-6 p-3">
            <p><h2>Debut</h2>{{ $intervention->debut }}</p>
        </div>
        <div class="col-md-6 p-3">
            <p><h2>Fin</h2>{{ $intervention->fin }}</p>
        </div>
    </div>
    <div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px ">
        <div class="col-md-6 p-3">
            <p><h2>Diagnostic</h2></p>
        </div>
    </div>
    <div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px ">
        <div class="col-md-6 p-3">
            <p><h2>Devis</h2></p>
        </div>
    </div>
    <div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px ">
        <div class="col-md-6 p-3">
            <p><h2>Maintenance/Réparation</h2></p>
        </div>
    </div>
@endsection