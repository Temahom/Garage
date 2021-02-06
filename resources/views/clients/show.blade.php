@extends('layout.index')
@section('content')
    <div class="row ml-1">
        <div class="col-md-5 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
            <div class="row">

                <div class="col-md-2 col-sm-3 text-center pt-3">
                    @if ($client->genre == "homme")
                        <img style="height: 50px;width: auto;" class="" src="/assets/images/masculin.png" alt="logo">
                    @else
                        <img style="height: 50px;width: auto;" class="" src="/assets/images/feminin.png" alt="logo">
                    @endif
                </div>

                <div class="col-md-10 col-sm-10">
                    <div style="font-size: 20px; color: #2EC551"><a href="{{route('clients.show',['client'=>$client->id])}}" style="color: #2EC551">{{ $client->prenom}}  {{ $client->nom}}</a></div>
                    <div style="font-size: 14px;"><i class="fas fa-home"></i> {{ $client->entreprise}}</div>
                    <div style="font-size: 14px;"><i class="fas fa-phone"></i> {{ $client->telephone}}</div>
                    <div style="font-size: 14px;"><i class="fas fa-envelope"></i> {{ $client->email}}</div>
                    <div class="text-right" style="font-size: 12px;">
                        <a class="text-primary mr-1" href="{{ route('clients.edit',$client->id)}}">Modifier</a> 
                        <a class="text-danger">Suppriler</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
  
                


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
           <div class="pull-right py-3">
				<a class="btn btn-secondary" href="{{route('clients.voitures.create',['client'=>$client->id])}}">Nouvelle Voiture</a>
			</div>
            <table class="table table-striped table-hover">
                <thead class="" style="background-color: #4656E9;">
                    <tr>
                        <th style="color: white;">Matricule</th>
                        <th style="color: white;">Marque</th>
                        <th style="color: white;">Model</th>
                        <th style="color: white;">Annee</th>
                        <th style="color: white;">Carburant</th>
                        <th style="color: white;">Puissance</th>
                        <th style="color: white;">Action</th>
                    </tr>
                </thead>
                @foreach ($voitures as $voiture)
                <tr>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer;">{{ $voiture->matricule}}</td>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->marque}}</td>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->model}}</td>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->annee}}</td>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->carburant}}</td>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->puissance}}</td>
                    <td>
                    <form action="{{ route('voitures.destroy',$voiture->id) }}" method="POST">   
                            <a class="btn btn-primary p-0 pr-2 pl-2" href="{{ route('voitures.edit',$voiture->id) }}"><i class="fas fa-edit"></i></a>   
                            @csrf
                            @method('DELETE')      
                            <button type="submit" class="btn btn-danger p-0 pr-2 pl-2"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                    
                @endforeach
            </table>
         </div>
         <div class="row">
            <div class="col-md-12 mt-3 d-flex justify-content-center">
                {!! $voitures->render() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ml-3 mt-3">
                <a class="btn btn-secondary" href="{{ route('clients.index') }}"> Retour</a>
            </div>
         </div>
           
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

	<script>
		function showVoiture(id)
		{
			window.location = '/voitures/' + id ;
		}
	</script>
@endsection