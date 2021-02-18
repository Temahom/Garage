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


    <form id="formDiag" action="{{ route('voitures.interventions.diagnostics.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
        {{ csrf_field() }}
                    

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-11" >
                    <div class="row p-3" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Constat:</strong>
                                <textarea id="constat" class="form-control" style="min-height: 30px;" name="constat"  placeholder="Entrer les observation issus du diagnostic"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                            <strong>Inspection(s):</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12" id="dynamicAddRemove">
                           <style>
                               #newdefaut
                               {
                                    border: 1px solid #D2D2E4;
                                    box-shadow: 0px 0px 3px #999;
                                    background-color: #fefefe;
                               }
                               #remove-button{
                                   color: #888;
                               }
                               #remove-button:hover{
                                   background-color: red;
                                   color: white;
                                   box-shadow: none;
                               }
                               #remove-button:focus{
                                   box-shadow: none;
                               }
                           </style>

                            <!-- INSPECTION -->
                            <div class="row p-3 mb-2" id="newdefaut">
                                <div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">
                                    <span class="numero">#1</span>
                                    <button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-2">
                                            <select name="plusdechamps[0][code]" id="codes" class="custom-select form-control">
                                                <option value="">Choisir code</option>
                                                @foreach ($listedefauts as $listedefaut)
                                                    <option value="{{$listedefaut->code}}">{{$listedefaut->code}}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div> 
                                        <div class="divLocalisation col-xs-12 col-sm-12 col-md-10">
                                            <input type="text" class="form-control localisation" name="plusdechamps[0][localisation]" placeholder="Localisation">
                                        </div>
                                    </div>
                                </div>
                                <div class="divDescription form-group col-xs-12 col-sm-12 col-md-12">
                                    <textarea class="form-control description" name="plusdechamps[0][description]" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">  
                                    <label style="margin-top: 6px; margin-left: 6px" class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="plusdechamps[0][etat]" value="1" class="custom-control-input" checked><span class="custom-control-label">Trés urgent</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="plusdechamps[0][etat]" value="2" class="custom-control-input" ><span class="custom-control-label">Pas urgent</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="plusdechamps[0][etat]" value="3" class="custom-control-input" ><span class="custom-control-label">Peut urgent</span>
                                    </label>
                                </div> 
                            </div>
                            <!-- FIN INSPECTION -->

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 p-4" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">
                            <button type="button" name="add" id="add-btn" class="btn btn-light" style="border-radius:15px">Ajouter une nouvelle inspection</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pl-0 py-4">
                    <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
                    <a class="btn btn-success" style="color: white" onclick="envoyerFormDiag()">Enregistrer</a>
                </div>
            </div>
        
    </form>
           

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script  type="text/javascript">
    var i = 1;
    var divDefaut;

    function getDiv(i) {
        divDefaut =  '<div class="row p-3 mb-2" id="newdefaut" style="border: 1px solid #D2D2E4">'+
        '<div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">'+
            '<span class="numero"></span>'+
            '<button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right">X</button>'+
        '</div>'+
        '<div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">'+
            '<div class="row">'+
                '<div class="col-xs-12 col-sm-12 col-md-2">'+
                    '<select name="plusdechamps['+i+'][code]" id="marques" class="custom-select form-control">'+
                    '<option value="code">Code</option>'+
                    '@foreach ($listedefauts as $listedefaut)'+
                        '<option value="{{$listedefaut->code}}">{{$listedefaut->code}}</option>'+
                    '@endforeach'+
                    '</select>'+
                '</div>'+
                '<div class="divLocalisation col-xs-12 col-sm-12 col-md-10">'+
                    '<input type="text" class="form-control" name="plusdechamps['+i+'][localisation]" placeholder="Localisation">'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="divDescription form-group col-xs-12 col-sm-12 col-md-12">'+
            '<textarea class="form-control"name="plusdechamps['+i+'][description]" placeholder="Description"></textarea>'+
        '</div>'+
        '<div class="form-group col-xs-12 col-sm-12 col-md-12">'+
            '<label style="margin-top: 6px; margin-left: 6px" class="custom-control custom-radio custom-control-inline">'+
                '<input type="radio" name="plusdechamps['+i+'][etat]" value="1" class="custom-control-input" checked><span class="custom-control-label">Trés urgent</span>'+
            '</label>'+
            '<label class="custom-control custom-radio custom-control-inline">'+
                '<input type="radio" name="plusdechamps['+i+'][etat]" value="2" class="custom-control-input" ><span class="custom-control-label">Pas urgent</span>'+
            '</label>'+
            '<label class="custom-control custom-radio custom-control-inline">'+
                '<input type="radio" name="plusdechamps['+i+'][etat]" value="3" class="custom-control-input" ><span class="custom-control-label">Peut urgent</span>'+
            '</label>'+
        '</div>'+
        '</div>';
        return divDefaut;
    }


    $("#add-btn").click(function(){
        div = getDiv(i);
        $("#dynamicAddRemove").append(div);
        numeroter();
        i++;
    });

    $(document).on('click', '#remove-button', function(){  
        $(this).parents('#newdefaut').remove();
        numeroter();
    });

    function numeroter() {
        var num = 1;
        $('#dynamicAddRemove > div').each( function(){
            $(this).children('.divSup').children('.numero').text('#' + num);
            num++;
        });
    }

    $(document).on('change', 'select', function(){  
        var parent = $(this).parents('#newdefaut');
        code = $(this).val();
        $.ajax({
            type: "GET",
            url: '/api/erreurByCode/' + code,
            dataType: 'json',
            success: function(data) {
                parent.children('.divDescription').children('textarea').removeClass('is-invalid');
                parent.children('div').children('div').children('.divLocalisation').children('input').removeClass('is-invalid');
                parent.children('.divDescription').children('textarea').val(data[0].description);
                parent.children('div').children('div').children('.divLocalisation').children('input').val(data[0].localisation);
            }
        });
    });

    /*CONTROL DIAGNOSTQUE*/
    function envoyerFormDiag()
    {
        var ok = 1;
        constat = $('#constat').val().trim();
        $('#constat').removeClass( "is-invalid" );
        if(constat == '')
        {
            $('#constat').addClass( "is-invalid" );
            ok = 0;
        }
        $('#dynamicAddRemove > div').each( function(){
            $(this).children('.divDescription').children('textarea').removeClass('is-invalid');
            $(this).children('div').children('div').children('.divLocalisation').children('input').removeClass('is-invalid');

            localisation = $(this).children('div').children('div').children('.divLocalisation').children('input').val().trim();
            description = $(this).children('.divDescription').children('textarea').val().trim();

            if(localisation == '')
            {
                $(this).children('div').children('div').children('.divLocalisation').children('input').addClass('is-invalid');
                ok = 0;
            }
            if(description == '')
            {
                $(this).children('.divDescription').children('textarea').addClass('is-invalid');
                ok = 0;
            }
        });
        if(ok)
        $('#formDiag').submit();
    }
    /* FIN CONTROL DIAGNOSTQUE*/
</script>
@endsection
