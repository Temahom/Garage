@extends('layout.index')
@php
setlocale(LC_TIME, "fr_FR", "French");
@endphp
@section('titre')
<div style="display: flex; justify-content:space-between;" >
    <h1>Devis</h1>
    <div class="input-group-append">
    <a href="/devis/create" class="btn btn-primary">Créer</a>
</div>
</div>
@endsection
@section('content')

<div class="card-body">

    <div class="table-responsive">
        <table class="table  table-bordered first" style="text-align: center;">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="text-transform: uppercase;">Date</th>
                    <th style="text-transform: uppercase;">Coût de Reparations</th>
                    <th style="text-transform: uppercase;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($devis as $devi)
                <tr>
                    <td>{{$devi->id}}</td>
                    <td>{{strftime("%A %d %B %Y", strtotime($devi->created_at))}}</td>
                    <td>{{number_format($devi->cout,0, ",", " " )}} <sup>F CFA</sup></td>
                    <td style="display: flex; justify-content:space-between;"> 
                        <a  href="/devis/{{$devi->id}}" class="btn btn-info m-2">voir</a>
                        <a  href="/devis/{{$devi->id}}/edit" class="btn btn-primary m-2">modifier</a>
                 <div class="m-2" >
                     <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$devi->id}}">
                            Supprimer
                         </button>
                    
                        <div class="modal" id="exampleModal{{$devi->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-body">
                            <form action="/devis/{{$devi->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <h5 class="text-center">Êtes vous sûr de supprimer ?</h5>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-danger">Oui ! Je Supprime</button>
                                </div>
                                
                        </form>
                    </div>
                </div>
            </div>
        </div>
                    </td>

                    
                </tr> 
                @endforeach
                
            </tbody>
            {{-- <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot> --}}
        </table>
       
    </div>
</div>
@endsection
        