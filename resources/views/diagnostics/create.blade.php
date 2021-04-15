@extends('layout.index')
  
@section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}">

@include('voitures._partials.carinformation')

<div class="row pt-5">
    <div class="col-lg-12">
        <div class="pull-left">
            <h2>DIAGNOSTIC</h2>
        </div>
    </div>
</div>  


    <form id="formDiag"
        @if (isset($defauts))
        action="{{ route('voitures.interventions.diagnostics.update',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'diagnostic' => $diagnostic->id]) }}" method="POST"
        @else
            action="{{ route('voitures.interventions.diagnostics.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST"
        @endif
    >
        @csrf
        @if (isset($defauts))
            @method('PUT')
        @endif
                    

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-11" >
                    <div class="row p-3" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Constat:</strong>
                                <textarea id="constat" class="form-control" style="min-height: 30px;" name="constat"  placeholder="Entrer les observation issus du diagnostic">@if(isset($diagnostic)){{ $diagnostic->constat }}@endif</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row p-3" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe; margin-top: 10px;">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <strong>Coût:</strong>
                                <input type="number" name="coût" id="coût" class="form-control" min="0" value="@if(isset($diagnostic)){{ $diagnostic->coût }}@endif">
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
                                    box-shadow: 0 10px 20px rgba(0,0,0,0.1), 0 6px 6px rgba(0,0,0,0.2);
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

                            @if (isset($defauts))
                                @php  $i = 0; @endphp
                                @foreach ($defauts as $defaut)
                                    @php  $i++; @endphp
                                
                                    <!-- INSPECTION RECUPERER -->
                                    <div class="row p-3 mb-2" id="newdefaut">
                                        <div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">
                                            <span class="numero">#{{ $i }}</span>
                                            <button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-2">
                                                    <select name="plusdechamps[{{ $i }}][code]" id="codes" class="custom-select form-control">
                                                        <option value="new">code</option>
                                                        @foreach ($listedefauts as $listedefaut)
                                                            <option value="{{$listedefaut->code}}" {{ $listedefaut->code == $defaut->code ? 'selected' : '' }}>{{$listedefaut->code}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div> 
                                                <div class="divLocalisation col-xs-12 col-sm-12 col-md-10">
                                                    <input value="{{ $defaut->localisation }}" type="text" class="form-control localisation" name="plusdechamps[{{ $i }}][localisation]" placeholder="Localisation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divDescription form-group col-xs-12 col-sm-12 col-md-12">
                                            <textarea class="form-control description" name="plusdechamps[{{ $i }}][description]" placeholder="Description">{{ $defaut->description }}</textarea>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12">  
                                            <label style="margin-top: 6px; margin-left: 6px" class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="plusdechamps[{{ $i }}][etat]" value="1" class="custom-control-input" {{ $defaut->etat == 1 ? 'checked' : '' }}><span class="custom-control-label">Trés urgent</span>
                                            </label>
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="plusdechamps[{{ $i }}][etat]" value="2" class="custom-control-input" {{ $defaut->etat == 2 ? 'checked' : '' }}><span class="custom-control-label">Pas urgent</span>
                                            </label>
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="plusdechamps[{{ $i }}][etat]" value="3" class="custom-control-input" {{ $defaut->etat == 3 ? 'checked' : '' }}><span class="custom-control-label">Peut urgent</span>
                                            </label>
                                        </div> 
                                    </div>
                                    <!-- FIN INSPECTION RECUPERER -->
                                @endforeach
                            @else
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
                                                    <option value="new">code</option>
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
                            @endif

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
                    <a class="btn btn-success" style="color: white; margin-left: 6px; " onclick="envoyerFormDiag()">Enregistrer</a>
                </div>
            </div>
        
    </form>
           

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script  type="text/javascript">
    var i = 1000;
    var nbItemDefaut = 1;
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
                    '<select name="plusdechamps['+i+'][code]" id="marques" class="custom-select form-control ">'+
                    '<option value="new">Code</option>'+
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
            '<textarea class="form-control" name="plusdechamps['+i+'][description]" placeholder="Description"></textarea>'+
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

    /*DEBUT gestion des doublons*/
        const doublon=()=>{
                    const selects = document.querySelectorAll('.custom-select');
                    selects.forEach((elem) => {
                        elem.addEventListener('change', (event) => {
                            let values = Array.from(selects).map(select => select.value);
                            for (let select of selects) {
                            select.querySelectorAll('option').forEach((option) => {
                                let value = option.value;
                                if (value &&  value !== select.value && values.includes(value)) {
                                    option.disabled = true;
                                } else {
                                    option.disabled = false;
                                }
                            });
                        }
                    });
                });
            }
            doublon();
        /*FIN gestion des doublons*/

    $("#add-btn").click(function(){
        div = getDiv(i);
        $("#dynamicAddRemove").append(div);
        doublon();
        numeroter();
        i++;
    });

    $(document).on('click', '#remove-button', function(){  
        $(this).parents('#newdefaut').remove();
        numeroter();
    });

    function numeroter() {
        var num = 0;
        $('#dynamicAddRemove > div').each( function(){
            num++;
            $(this).children('.divSup').children('.numero').text('#' + num);
        });
        nbItemDefaut = num;
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
        coût = $('#coût').val().trim();
        $('#coût').removeClass( "is-invalid" );
        if(coût == '')
        {
            $('#coût').addClass( "is-invalid" );
            ok = 0;
        }
        if(nbItemDefaut == 0)
        {
            alert('Ajouter au moins une inspection');
            return 0;
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
        if(ok){
            $('#formDiag').submit();
        }
        else{
            alert('il y\'a au moins un champs vide');
        }
    }
    /* FIN CONTROL DIAGNOSTQUE*/
</script>
@endsection
