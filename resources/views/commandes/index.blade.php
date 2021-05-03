@include('animate_gestion_stock')
@extends('layout.menu')
@php
setlocale(LC_TIME, "fr_FR", "French");
    use App\Models\User;
    use App\Models\Client;
    
@endphp
@section('content')
<style>
    .swal-modal .swal-text {
    text-align: center;
}
    .titre{
            background-image: linear-gradient(to left, #268956, #332F30);
            color:#fff;
            border-radius:20px;
            padding:0 10px;
            padding:10px;
    }
    .label{
        margin-right: 5px;
    }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>
                    <span class="titre"><i class="fas fa-list-ul label"></i>Liste des Commandes</span>
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
        <div class="col-xs-12 col-sm-12 col-md-12 "><br>    
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="table table-striped table-bordered" style="width:100%">
                            <thead  class="" style="background-color: #006680;">
                                <tr>
                                    <th style="color: white; text-align:center; width: 3%" style="cursor: pointer;">N°</th>
                                    <th style="color: white; text-align:center; " style="cursor: pointer;">Expéditeur</th>
                                    <th style="color: white; text-align:center; " style="cursor: pointer;">Etat</th>
                                    <th style="color: white; text-align:center; " style="cursor: pointer;">Date</th>
                                    <th style="color: white; text-align: center;" style="cursor: pointer;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commandes as $commande)
                                <tr>
                                    <td style="cursor: pointer; text-align: center">{{ $commande->id }}</td>
                                    <td style="cursor: pointer; text-align: center">{{ User::find($commande->passer_par)->name }}</td>
                                    <td style="cursor: pointer; text-align: center">{!! $commande->etat==1? "<span class='badge badge-info' >Commande en cours</span>":"<span class='badge badge-success'  >Commande validée</span>" !!}</td>
                                    <td style="cursor: pointer; text-align: center">{{ $commande->created_at}}</td>
                                    <td style="text-align: center">
                                        @if($commande->etat==1)
                                        <a class="btn btn-info" href="{{ route('commandes.valider', $commande->id) }}" title="Valider la commande">Valider</a>
                                        @endif
                                        <a class="btn btn-success" href="{{ route('commandes.show', $commande->id) }}" title="Voir la commande">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>                                        
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(Session::has('valide_error'))
<script>
	swal("Attention!", "{!! Session::get('valide_error') !!}", "warning");
</script>
@endif     
@if(Session::has('valider'))
<script>
	swal("Valider", "{!! Session::get('valider') !!}", "success");
</script>
@endif     


@endsection
