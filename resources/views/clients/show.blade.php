@extends('layout.index')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 style="color: #2EC551">Informations</h2>
            </div>
        </div>
    </div>

    <table>
        <tr>
            <td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Nom:</label>
            </td>
            <td>
                <label style="font-size: 20px;">&nbsp&nbsp&nbsp {{ $client->prenom}}  {{ $client->nom}}</label>
            </td>
        </tr>
        <tr>
            <td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Entreprise:</label>
            </td>
            <td>
                <label style="font-size: 20px;">&nbsp&nbsp&nbsp{{ $client->entreprise}}</label>
            </td>
        </tr>
        <tr>
            <td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Téléphone:</label>
            </td>
            <td>
                <label style="font-size: 20px;">&nbsp&nbsp&nbsp{{ $client->telephone}}</label>
            </td>
        </tr>
        <tr>
            <td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Email:</label>
            </td>
            <td>
                <label style="font-size: 20px;">&nbsp&nbsp&nbsp{{ $client->email}}</label>
            </td>
        </tr>
    </table>
    <br><br>

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