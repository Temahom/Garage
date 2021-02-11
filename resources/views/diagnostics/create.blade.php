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
        

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajouter un Nouveau diagnostic</h2>
            </div>
        </div>
    </div>  


    <form action="{{ route('voitures.interventions.diagnostics.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Constat</strong>
                                <textarea class="form-control" style="min-height: 30px;" name="constat"  placeholder="Entrer les observation issus du diagnostic"> {{ isset($diagnostic) ? $diagnostic->constat :''}}</textarea>
                            </div>
                        </div>
                    </div>

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
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6" id="dynamicAddRemove">
                            <strong>Inspections</strong>
                            <div class="row" style="border: 1px solid #D2D2E4">

                                <div class="input-group form-group col-xs-12 col-sm-12 col-md-12">
                                    <div class="input-group-prepend"><span class="input-group-text" id="inputGroup">Titre</span></div>
                                    <input type="text" class="form-control" aria-label="plusdechamps[0][title]" aria-describedby="inputGroup" name="plusdechamps[0][title]">
                                </div>
                                <div class="input-group form-group col-xs-12 col-sm-12 col-md-12">
                                    <div class="input-group-prepend"><span class="input-group-text">Localisation de la panne</span></div>
                                    <textarea class="form-control"name="localisation" aria-label="localisation">{{ isset($diagnostic) ? $diagnostic->localisation :''}}</textarea>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">  
                                    <div class="input-group-prepend"><span class="input-group-text">Appréciation</span>
                                        <label style="margin-top: 4px" class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="plusdechamps[0][description]" value="trés urgent" class="custom-control-input" ><span class="custom-control-label">Trés urgent</span>
                                        </label>
                                        <label style="margin-top: 4px" class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="plusdechamps[0][description]" value="pas urgent" class="custom-control-input" ><span class="custom-control-label">Pas urgent</span>
                                        </label>
                                        <label style="margin-top: 4px" class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="plusdechamps[0][description]" value="peut urgent" class="custom-control-input" ><span class="custom-control-label">Peut urgent</span>
                                        </label>
                                    </div>
                                </div> 
                                <div>
                                    <button type="button" name="add" id="add-btn" class="btn btn-success">Ajouter un diagnostic</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                     <br>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
           

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script >
    var i = 0;
    $("#add-btn").click(function(){
    ++i;
    dynamicAddRemove = '<div class="row" style="border: 1px solid #D2D2E4">'+
                '<div class="input-group form-group col-xs-12 col-sm-12 col-md-12">'+
                    '<div class="input-group-prepend"><span class="input-group-text" id="inputGroup">Titre</span></div>'+
                    '<input type="text" class="form-control" aria-label="plusdechamps[0][title]" aria-describedby="inputGroup" name="plusdechamps[0][title]">'+
                '</div>'+
                '<div class="input-group form-group col-xs-12 col-sm-12 col-md-12">'+
                    '<div class="input-group-prepend"><span class="input-group-text">Localisation de la panne</span></div>'+
                    '<textarea class="form-control"name="localisation" aria-label="localisation">{{ isset($diagnostic) ? $diagnostic->localisation :''}}</textarea>'+
                '</div>'+
                '<div class="form-group col-xs-12 col-sm-12 col-md-12">'+  
                    '<div class="input-group-prepend"><span class="input-group-text">Appréciation</span>'+
                        '<label style="margin-top: 4px" class="custom-control custom-radio custom-control-inline">'+
                            '<input type="radio" name="plusdechamps[0][description]" value="trés urgent" class="custom-control-input" ><span class="custom-control-label">Trés urgent</span>'+
                        '</label>'+
                        '<label style="margin-top: 4px" class="custom-control custom-radio custom-control-inline">'+
                            '<input type="radio" name="plusdechamps[0][description]" value="pas urgent" class="custom-control-input" ><span class="custom-control-label">Pas urgent</span>'+
                        '</label>'+
                        '<label style="margin-top: 4px" class="custom-control custom-radio custom-control-inline">'+
                            '<input type="radio" name="plusdechamps[0][description]" value="peut urgent" class="custom-control-input" ><span class="custom-control-label">Peut urgent</span>'+
                        '</label>'+
                    '</div>'+
                '</div>'+;
    $("#dynamicAddRemove").append(dynamicAddRemove);
    });
    $(document).on('click', '.remove-<div class="form-group col-xs-12 col-sm-12 col-md-12"> ', function(){  
    $(this).parents('<div class="form-group col-xs-12 col-sm-12 col-md-12"> ').remove();
    });  
</script>
@endsection
