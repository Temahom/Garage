@extends('layout.index')

@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <br><h2>Liste des Voitures</h2><br>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="col-xs-9 col-sm-9 col-md-9">     
                     <div class="form-group">
                         @can('create', App\Models\Voiture::class)
                         <a class="btn btn-secondary" href="{{ route('voitures.create') }}"><i class="fas fa-plus"></i> Ajouter Voiture</a>
                        @endcan
                     </div>
                 </div>   
                 <div class="col-xs-3 col-sm-3 col-md-3">     
                     <div class="form-group">
                         <form action="{{ route('voitures.index') }}" method="GET" role="search">
                             <div class="d-flex">
                                 <input type="text" class="form-control mr-2" name="term" placeholder="Rechercher ici " id="term" autocomplete="off">
                                 <button class="btn btn-info t" type="submit" title="recherche une voiture">
                                     <span class="fas fa-search"></span>
                                 </button>
                             </div>
                         </form><br>
                     </div>
                 </div>   
             </div>    
             
        </div>
    </div>
    <style>
        svg{
            display: none;
        }
    </style>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div> 
    
        @endif
    <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 row"><br>
        <table class="table table-striped table-hover col-md-12">
            <thead class="" style="background-color: #4656E9;">
        <tr>
            <th style="color: white;">Matricule</th>
            <th style="color: white;">Marque</th>
            <th style="color: white;">Model</th>
            <th style="color: white;">Annee</th>
            <th style="color: white;">Carburant</th>
            <th style="color: white;">Propriètaire</th>
            <th style="color: white;">Enregistré par</th>
            <th style="color: white;">Action</th>
        </tr>
            </thead>
        @foreach ($voitures as $voiture)
        <tr>
            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->matricule}}</td>
            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->marque}}</td>
            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->model}}</td>
            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->annee}}</td>
            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->carburant}}</td>
            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->client()->first()->prenom.' '.$voiture->client()->first()->nom}}</td>
            <!--  <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->puissance}}</td>-->
            <td> <div> {{(Auth::user()->id==$voiture->user_id)? 'Vous' :$voiture->user()->first()->name}} <span class="badge badge-secondary capitalize">{{$voiture->user()->first()->role()->first()->role}}</span></div> 
                
            <td>
            {{-- <form action="{{ route('voitures.destroy',$voiture->id) }}" method="POST">    --}}
                    <a class="btn btn-primary  p-0 pr-2 pl-2" href="{{ route('voitures.edit',$voiture->id) }}"><i class="fas fa-edit"></i></a>
                    <button type="button" class="btn btn-danger  p-0 pr-2 pl-2" data-toggle="modal" data-target="#exampleModal{{ $voiture->id }}">
                        <i class="fas fa-trash"></i>
                    </button> 
                    <div class="modal fade" id="exampleModal{{ $voiture->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-body">
									<h5>Voulez vous vraiment supprimer <strong>la {{ $voiture->marque }} de {{ $voiture->matricule }} de liste des voitures</strong>  ?</h5>
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
                
            </td>
        </tr>
            
        @endforeach
    </table>
    </div>
    </div>
    <div class="row">
		<div class="col-md-12 mt-3 d-flex justify-content-center">
			{!! $voitures->links() !!}
		</div>
	</div>

    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

	<script>
		function showVoiture(id)
		{
			window.location = 'voitures/' + id ;
		}
	</script>

<script>
    const compare = (ids, asc) => (row1, row2) => {
        const tdValue = (row, ids) => row.children[ids].textContent;
        const tri = (v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
        return tri(tdValue(asc ? row1 : row2, ids), tdValue(asc ? row2 : row1, ids));
    };
        const tbody = document.querySelector('tbody');
        const thx = document.querySelectorAll('th');
        const trxb = tbody.querySelectorAll('tr');

            thx.forEach(th => th.addEventListener('click', () => {
                let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
                classe.forEach(tr => tbody.appendChild(tr));
            }));
</script>

@endsection