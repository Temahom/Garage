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
    </table>
    <br><br>

     </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
           <div class="pull-right py-3">
				<a class="btn btn-success" href="{{route('clients.voitures.create',['client'=>$client->id])}}">Ajouter Voiture</a>
			</div>
            <table class="table table-bordered">
                <tr>
                    <th>Matricule</th>
                    <th>Marque</th>
                    <th>Model</th>
                    <th>Annee</th>
                    <th>Carburant</th>
                    <th>Puissance</th>
                    <th width='275px'>Action</th>
                </tr>
                @foreach ($voitures as $voiture)
                <tr>
                    <td>{{ $voiture->matricule}}</td>
                    <td>{{ $voiture->marque}}</td>
                    <td>{{ $voiture->model}}</td>
                    <td>{{ $voiture->annee}}</td>
                    <td>{{ $voiture->carburant}}</td>
                    <td>{{ $voiture->puissance}}</td>
                    <td>
                    <form action="{{ route('voitures.destroy',$voiture->id) }}" method="POST">   
                            <a class="btn btn-info" href="{{ route('voitures.show',$voiture->id) }}"><i class="fas fa-eye mr-2"></i></a>    
                            <a class="btn btn-primary" href="{{ route('voitures.edit',$voiture->id) }}"><i class="fas fa-edit mr-2"></i></a>   
                            @csrf
                            @method('DELETE')      
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt mr-2"></i></button>
                        </form>
                    </td>
                </tr>
                    
                @endforeach
            </table>
         </div>

        <div class="row">
            <div class="col-md-12 ml-3 mt-3">
                <a class="btn btn-secondary" href="{{ route('clients.index') }}"> Retour</a>
            </div>
         </div>
           
    </div>
@endsection