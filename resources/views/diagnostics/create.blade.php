@extends('layout.index')
  
@section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
<div class="row ml-1">
    <div class="col-md-7 pt-3"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
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
        

    <div class="row pt-5">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>DIAGNOSTIC</h2>
            </div>
        </div>
    </div>  


    <form action="{{ route('voitures.interventions.diagnostics.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
        {{ csrf_field() }}
                    

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="row p-3" style="border: 1px solid #D2D2E4">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Constat</strong>
                                <textarea class="form-control" style="min-height: 30px;" name="constat"  placeholder="Entrer les observation issus du diagnostic">
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <strong>Inspections</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12" id="dynamicAddRemove">
                           

                            <div class="row p-3" style="border: 1px solid #D2D2E4">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-2">
                                            <select name="code" id="codes" class="custom-select form-control" @error('code') is-invalid @enderror">
                                            <option value="">Code</option>
                                            {{-- @foreach ($codes as $code)
                                                <option value="{{$defaut->codes}}">{{$defaut->codes}}</option>
                                            @endforeach --}}
                                            </select>	
                                            <div class="invalid-feedback">
                                                @if($errors->has('code'))
                                                {{ $errors->first('code') }}
                                                @endif
                                            </div>
                                        </div> 
                                        <div class="col-xs-12 col-sm-12 col-md-10">
                                            <input type="text" class="form-control" name="plusdechamps[0][localisation]" placeholder="Localisation">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                    <textarea class="form-control"name="plusdechamps[0][description]" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">  
                                    <label style="margin-top: 6px; margin-left: 6px" class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="plusdechamps[0][etat]" value="0" class="custom-control-input" ><span class="custom-control-label">Trés urgent</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="plusdechamps[0][etat]" value="1" class="custom-control-input" ><span class="custom-control-label">Pas urgent</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="plusdechamps[0][etat]" value="2" class="custom-control-input" ><span class="custom-control-label">Peut urgent</span>
                                    </label>
                                </div> 
                            </div>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 py-2" style="border: 1px solid #D2D2E4">
                            <button type="button" name="add" id="add-btn" class="btn btn-light" style="border-radius:30px/15px">Ajouter une nouvelle inspection</button>
                        </div>
                    </div>

                </div>
            </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
           

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script  type="text/javascript">
    var i = 0;

var divDefaut;
divDefaut =  '<div class="row p-3" id="newdefaut" style="border: 1px solid #D2D2E4">'+
    '<div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">'+
        '<div class="row">'+
            '<div class="col-xs-12 col-sm-12 col-md-2">'+
                '<select name="plusdechamps['+i+'][code]" id="marques" class="custom-select form-control">'+
                '<option value="code">Code</option>'+
                '</select>'+
            '</div>'+
            '<div class="col-xs-12 col-sm-12 col-md-10">'+
                '<input type="text" class="form-control" name="plusdechamps['+i+'][localisation]" placeholder="Localisation">'+
            '</div>'+
        '</div>'+
    '</div>'+
    '<div class="form-group col-xs-12 col-sm-12 col-md-12">'+
        '<textarea class="form-control"name="plusdechamps['+i+'][description]" placeholder="Description"></textarea>'+
    '</div>'+
    '<div class="form-group col-xs-12 col-sm-12 col-md-12">'+
        '<label style="margin-top: 6px; margin-left: 6px" class="custom-control custom-radio custom-control-inline">'+
            '<input type="radio" name="plusdechamps['+i+'][etat]" value="0" class="custom-control-input" ><span class="custom-control-label">Trés urgent</span>'+
        '</label>'+
        '<label class="custom-control custom-radio custom-control-inline">'+
            '<input type="radio" name="plusdechamps['+i+'][etat]" value="1" class="custom-control-input" ><span class="custom-control-label">Pas urgent</span>'+
        '</label>'+
        '<label class="custom-control custom-radio custom-control-inline">'+
            '<input type="radio" name="plusdechamps['+i+'][etat]" value="2" class="custom-control-input" ><span class="custom-control-label">Peut urgent</span>'+
        '</label>'+
    '</div>'+
    '<div class="form-group col-xs-12 col-sm-12 col-md-12">'+
        '<button type="button" class="btn btn-danger" id="remove-button" style="border-radius:30px/15px">Supprimer</button>'+
    '</div>'+
    '</div>';


    $("#add-btn").click(function(){
        ++i;
        $("#dynamicAddRemove").append(divDefaut);
    });
    $(document).on('click', '#remove-button', function(){  
            $(this).parents('#newdefaut').remove();
            });
</script>
@endsection
