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
               <!--  <div class="col-xs-3 col-sm-3 col-md-3">     
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
                    </div>  --> 
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
            <div class="col-xs-12 col-sm-12 col-md-12 row">  
            <div class="col-xs-12 col-sm-12 col-md-12 "><br>
              
                <div class="card">
                    <!--<div class="card-header">
                        <h3 class="mb-0 text-center">La Liste de clients</h3>
                        {{-- <p>This example shows FixedHeader being styled by the Bootstrap 4 CSS framework.</p> --}}
                    </div>-->
                    <div class="card-body">
                        <div class="table-responsive">
                    <table id="example4" class="table  table-striped table-bordered" style="width:100%">
                    <thead class="" style="background-color: #4656E9;">
                        <tr>
                            <th style="color: white;">N°</th>
                            <th style="color: white;">Matricule</th>
                            <th style="color: white;">Marque</th>
                            <th style="color: white;">Model</th>
                            <th style="color: white;">Annee</th>
                            <th style="color: white;">Carburant</th>
                            <th style="color: white;">Propriètaire</th>
                            <th style="color: white;">Enregistré par</th>
                            @can('create', App\Models\Voiture::class)
                            <th style="color: white;">Action</th>
                            @endcan
                        </tr>
                    </thead>
                    @if($interventionAssignees && App\Models\Role::find(Auth::id())->role == 'Mecanicien' )
                      @foreach ($interventionAssignees as $voiture)
                          <tr>
                            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->voiture()->first()->id}}</td>
                            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->voiture()->first()->matricule}}</td>
                            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->voiture()->first()->marque}}</td>
                            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->voiture()->first()->model}}</td>
                            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->voiture()->first()->annee}}</td>
                            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->voiture()->first()->carburant}}</td>
                            <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->voiture()->first()->client()->first()->prenom.' '.$voiture->voiture()->first()->client()->first()->nom}}</td>
                            <td> <div> {{(Auth::user()->id==$voiture->user_id)? 'Vous' :$voiture->voiture()->first()->user()->first()->name}} <span class="badge badge-secondary capitalize">{{$voiture->user()->first()->role()->first()->role}}</span></div> 
                          </tr>
                      @endforeach 
                    @else
                @foreach ($voitures as $voiture)
                <tr>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->id}}</td>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->matricule}}</td>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->marque}}</td>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->model}}</td>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->annee}}</td>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->carburant}}</td>
                    <td onclick="showVoiture({{ $voiture->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $voiture->client()->first()->prenom.' '.$voiture->client()->first()->nom}}</td>
                    <td> <div> {{(Auth::user()->id==$voiture->user_id)? 'Vous' :$voiture->user()->first()->name}} <span class="badge badge-secondary capitalize">{{$voiture->user()->first()->role()->first()->role}}</span></div>            
                   @can('update', $voiture)
                    <td>
                    {{-- <form action="{{ route('voitures.destroy',$voiture->id) }}" method="POST">    --}}
                            <a class="btn btn-primary  p-0 pr-2 pl-2" href="{{ route('voitures.edit',$voiture->id) }}"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger  p-0 pr-2 pl-2 hide_delete" data-toggle="modal" data-target="#exampleModal{{ $voiture->id }}">
                                <i class="fas fa-trash"></i>
                            </button> 
                            <div class="modal fade" id="exampleModal{{ $voiture->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h5>Voulez vous vraiment supprimer <strong>la {{ $voiture->marque }} de {{ $voiture->matricule }} de liste des voitures</strong>  ?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary hide_delete" data-dismiss="modal">Annuler</button>
                                            <form action="{{route('voitures.destroy',$voiture->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                    </td>
                    @endcan
                </tr>
            
                @endforeach
        @endif
    </table>
    </div>
    </div>
    </div>
    </div>
    </div></div>
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