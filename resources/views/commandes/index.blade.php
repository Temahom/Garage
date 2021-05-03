@include('animate_gestion_stock')
@extends('layout.menu')
@php
setlocale(LC_TIME, "fr_FR", "French");
    use App\Models\User;
    
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
<br>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example4" class="table table-striped table-bordered">
                    
                    <thead  class="" style="background-color: #006680;">
                        <tr>
                            <th style="color: white; width: 3%" style="cursor: pointer;">N°</th>
                            <th style="color: white;" style="cursor: pointer;">Passer par</th>
                            <th style="color: white;" style="cursor: pointer;">Etat</th>
                            <th style="color: white;" style="cursor: pointer;">Date</th>
                            <th style="color: white; text-align: center" style="cursor: pointer;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>{{ User::find($commande->passer_par)->name }}</td>
                            <td>{!! $commande->etat==1? "<span class='badge badge-warning'>Passer</span>":"<span class='badge badge-success' >Valideé</span>" !!}</td>
                            <td>{{strftime("%A %d %B %Y", strtotime($commande->created_at))}}</td>
                            <td>
                                @if ($commande->etat==1)
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
