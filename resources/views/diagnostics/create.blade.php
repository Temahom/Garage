@extends('layout.index')
  
@section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
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
        
        
<div class="container">
            <div class="card-body">
                <form action="{{ route('voitures.interventions.diagnostics.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
                @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    <table class="table table-bordered" id="dynamicAddRemove">  
                        <thead class="" style="background-color: #4656E9;">
                            <tr>
                                <th style="color: white;">Titre</th>
                                <th style="color: white;">Description</th>
                                <th style="color: white;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>  
                                <td>
                                    <input type="text" name="plusdechamps[0][title]" placeholder="Entrer title" class="form-control" />
                                </td>
                                <td>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="plusdechamps[0][description]" value="trés urgent" class="custom-control-input" ><span class="custom-control-label">Trés urgent</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="plusdechamps[0][description]" value="pas urgent" class="custom-control-input" ><span class="custom-control-label">Pas urgent</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="plusdechamps[0][description]" value="peut urgent" class="custom-control-input" ><span class="custom-control-label">Peut urgent</span>
                                    </label>
                                </td>  
                                <td>
                                    <button type="button" name="add" id="add-btn" class="btn btn-success">Ajouter un diagnostic</button>
                                </td>  
                            </tr>  
                        </tbody>
                    </table> 
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script >
    var i = 0;
    $("#add-btn").click(function(){
    ++i;
    $("#dynamicAddRemove").append('<tr><td><input type="text" name="plusdechamps['+i+'][title]" placeholder="Enter title" class="form-control" /></td><td> <label class="custom-control custom-radio custom-control-inline"><input type="radio" name="plusdechamps['+i+'][description]" value="trés urgent" class="custom-control-input" ><span class="custom-control-label">Trés urgent</span></label> <label class="custom-control custom-radio custom-control-inline"><input type="radio" name="plusdechamps['+i+'][description]" value="pas urgent" class="custom-control-input" ><span class="custom-control-label">Pas urgent</span></label> <label class="custom-control custom-radio custom-control-inline"><input type="radio" name="plusdechamps['+i+'][description]" value="peut attendre" class="custom-control-input" ><span class="custom-control-label">Peut attendre</span></label></td><td><button type="button" class="btn btn-danger remove-tr">Supprimer</button></td></tr>');
    });
    $(document).on('click', '.remove-tr', function(){  
    $(this).parents('tr').remove();
    });  
</script>
@endsection
