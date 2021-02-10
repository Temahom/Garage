@extends('layout.index')

@extends('layout.index')
@php
	use App\Models\listeproduit;
    $listes=listeproduit::select('categorie')->orderBy('categorie','asc')->distinct()->get();
							
@endphp

@section('content')

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="row ml-1">
    <div class="col-md-7 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
        <div class="row">

            <div class="col-md-2 col-sm-3 text-center pt-4">
                <img style="height: 50px;width: auto;" class="" src="/assets/images/car.png" alt="logo">
            </div>

            <div class="col-md-10 col-sm-10">

                <div style="font-size: 20px">
                    <a href="{{route('voitures.show',['voiture'=>$voiture->id])}}" style="color: #2EC551">
                        {{ $voiture->matricule }}
                    </a>
                    <span style="font-size: 12px;">
                        ( De<a href="{{route('clients.show',['client'=>$voiture->client_id])}}" style="color: #2EC551">
                            <i class="fas fa-user"></i>
                            {{ $voiture->client()->first()->prenom.' '.$voiture->client()->first()->nom}}
                        </a>)
                    </span>
                    
                </div>

                <div style="font-size: 14px;"> {{ $voiture->marque}} {{ $voiture->model}} {{ $voiture->annee}}</div>
                <div style="font-size: 14px;"> {{ $voiture->carburant}}</div>
                <div style="font-size: 14px;"> {{ $voiture->puissance}} cheveaux</div>
                <div class="text-right" style="font-size: 12px;">
                    <a class="text-primary mr-1" href="{{ route('voitures.edit',$voiture->id)}}">Modifier</a> 
                    <button type="button" class="text-danger" style="border: none; cursor: pointer" data-toggle="modal" data-target="#exampleModal{{ $voiture->id }}">
                        Supprimer
                    </button>
                    <div class="modal fade" id="exampleModal{{ $voiture->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h5>Voulez vous supprimer: <strong>{{ $voiture->matricule }}</strong>  ?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <form action="{{route('voitures.destroy',$voiture->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                            </div>
                            </div>
                        </div>
                    </div>	
                </div>

            </div>

        </div>
    </div>
</div> 

<div class="card-body">
    <form action="{{ route('voitures.interventions.devis.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cout" class="col-form-label">Coût de Réparation</label>
            <input id="cout" type="number" name="cout" required class="form-control" placeholder="Coût de réparation">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3 p-0">
            <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
    </form>
</div>

@endsection