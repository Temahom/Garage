@extends('clients.layout')

@section('content')
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>Tous les Clients</h2>
			</div>
			<div class="pull-right">
				<a class="btn btn-success" href="{{route('clients.create')}}">Enregistrer un Client</a>
			</div>
		</div>
	</div>
	<br>
	<br>

	@if($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{$message}}</p>
		</div>
	@endif

	<table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénoms</th>
            <th>Genre</th>
            <th>Entreprise</th>
            <th>Téléphone</th>
            <th width="350px">Action</th>
        </tr>
        @foreach ($clients as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->nom }}</td>
            <td>{{ $client->prenom }}</td>
            <td style="text-transform: capitalize;">{{ $client->genre }}</td>
            <td>{{ $client->entreprise }}</td>
            <td>{{ $client->telephone }}</td>
            <td style="display: flex; justify-content: space-between;">
            	 <a class="btn btn-success" href="{{route('clients.show',$client->id)}}">Voir</a>
    
                    <a class="btn btn-primary" href="{{ route('clients.edit',$client->id)}}">Modifier</a>
            	<div>
            		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $client->id }}">
   		 				Supprimer
					</button>
            		<div class="modal fade" id="exampleModal{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-body">
					        <form action="{{route('clients.destroy',$client->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <h5>Voulez vous supprimer: <strong>{{ $client->nom }} {{ $client->prenom }}</strong>  ?</h5>
                
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					        <button type="submit" class="btn btn-danger">Supprimer</button>
					        </form>
					      </div>
					    </div>
					  </div>
					</div>
            	</div>	
            	
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $clients->links() !!}
      
@endsection
   
