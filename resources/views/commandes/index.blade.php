@include('animate_gestion_stock')
@extends('layout.menu')
@php
    use App\Models\User;
@endphp
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Commande </h2>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example4" class="table table-striped table-bordered">
                    
                    <thead  class="" style="background-color: #4656E9;">
                        <tr>
                            <th style="color: white;" style="cursor: pointer;">N°</th>
                            <th style="color: white;" style="cursor: pointer;">Passer par</th>
                            <th style="color: white;" style="cursor: pointer;">Etat</th>
                            <th style="color: white;" style="cursor: pointer;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>{{ User::find($commande->passer_par)->name }}</td>
                            <td>{!! $commande->etat==1? "<span>Commande passer</span>":"<span>Commande valider</span>" !!}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('commandes.valider', $commande->id) }}" title="Valider la commande">Valider</a>
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
