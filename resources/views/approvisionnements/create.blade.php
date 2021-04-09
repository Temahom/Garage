@extends('layout.index')
  
@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajouter un approvisionnement</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('approvisionnements.index') }}" title="Go back"> <i class="fas fa-backward "></i> Retour</a>
            </div>
        </div>
    </div>
</div>
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

     <form action="{{ route('approvisionnements.store') }}" method="POST" >
            @csrf
          <!--     <div class="row">    
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="col-xs-6 col-sm-6 col-md-6">    
                        <div class="form-group">
                            <strong>Fournisseur</strong>
                                <select name="fournisseur_id" class="custom-select form-control  @error('fournisseur_id') is-invalid @enderror" >
                                    @if(!empty($fournisseur->id))
                                        <option value="{{$fournisseur->id}}">{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                    @else   
                                        @foreach( $fournisseurs as $fournisseur ) 
                                            <option value="{{$fournisseur->id}}" {{ old('fournisseur_id') == ($fournisseur->id) ? 'selected' : '' }} {{$approvisionnement->fournisseur_id == $fournisseur->id ? 'selected':'' }}>{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                        @endforeach 
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                  @if($errors->has('fournisseur_id'))
                                    Le champs Fournisseur est obligatoire.
                                  @endif
                                </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Nom du produit:</strong>
                            <input class="form-control" name="nomProduit" placeholder="nom du produit">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Quantité Totale:</strong>
                                <input type="number" name="qteTotale" class="form-control" placeholder="qteTotale">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Prix Total:</strong>
                                <input type="number" name="prixTotal" class="form-control" placeholder="prixTotal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                            <strong>Inspection(s):</strong>
                        </div>
                    </div>-->
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

                            <div class="row">    
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                                    <div class="form-group">
                                        <strong>Fournisseur</strong>
                                            <select name="fournisseur_id" class="custom-select form-control  @error('fournisseur_id') is-invalid @enderror" >
                                                @if(!empty($fournisseur->id))
                                                    <option value="{{$fournisseur->id}}">{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                                @else   
                                                    @foreach( $fournisseurs as $fournisseur ) 
                                                        <option value="{{$fournisseur->id}}" {{ old('fournisseur_id') == ($fournisseur->id) ? 'selected' : '' }} {{$approvisionnement->fournisseur_id == $fournisseur->id ? 'selected':'' }}>{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                                    @endforeach 
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">
                                            @if($errors->has('fournisseur_id'))
                                                Le champs Fournisseur est obligatoire.
                                            @endif
                                            </div>
                                    </div>
                                </div>
                            </div>
                    
                            @if (isset($approvisionnements))
                                @php  $i = 0; @endphp
                                @foreach ($approvisionnements as $approvisionnement)
                                    @php  $i++; @endphp

                                    
                                
                                    <!-- INSPECTION RECUPERER -->
                                    <div class="row" id="newdefaut">
                                        <div class="divSup col-xs-12 col-sm-12 col-md-12">
                                            <button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-2">
                                                    <div class="form-group">
                                                        <strong>Nom du produit:</strong>
                                                        <input class="form-control" name="nomProduit" placeholder="nom du produit">
                                                    </div>
                                                </div> 
                                                <div class="col-xs-12 col-sm-12 col-md-2">
                                                    <div class="form-group">
                                                        <strong>Quantité Totale:</strong>
                                                        <input type="number" name="qteTotale" class="form-control" placeholder="qteTotale">
                                                    </div>
                                                </div> 
                                                <div class="col-xs-12 col-sm-12 col-md-2">
                                                    <div class="form-group">
                                                        <strong>Prix Total:</strong>
                                                        <input type="number" name="prixTotal" class="form-control" placeholder="prixTotal">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN INSPECTION RECUPERER -->
                                @endforeach
                            @else
                                <!-- INSPECTION -->
                                <div class="row p-3 mb-2" id="newdefaut">
                                    <div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">
                                        <button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>
                                    </div>

                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <strong>Nom du produit:</strong>
                                                        <input class="form-control" name="nomProduit" placeholder="nom du produit">
                                                    </div>
                                                </div> 
                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <strong>Quantité Totale:</strong>
                                                        <input type="number" name="qteTotale" class="form-control" placeholder="qteTotale">
                                                    </div>
                                                </div> 
                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <strong>Prix Total:</strong>
                                                        <input type="number" name="prixTotal" class="form-control" placeholder="prixTotal">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div> 
                                </div>
                                <!-- FIN INSPECTION -->
                            @endif
                        </div>
                    </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 p-4" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">
                                    <button type="button" name="add" id="add-btn" class="btn btn-light" style="border-radius:15px">Ajouter un nouveau produit</button>
                                </div>
                            </div>

                            <br>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
            
 

<script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script  type="text/javascript">
    var i = 1000;
    var nbItemDefaut = 1;
    var divDefaut;

    function getDiv(i) {
        divDefaut =   '<div class="row p-3 mb-2" id="newdefaut">'+
                                    '<div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">'+
                                        '<button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>'+
                                        '</div>'+

                                        '<div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">'+
                                            '<div class="row">'+
                                                '<div class="col-xs-12 col-sm-12 col-md-4">'+
                                                    '<div class="form-group">'+
                                                        '<strong>Nom du produit:</strong>'+
                                                        '<input class="form-control" name="nomProduit" placeholder="nom du produit">'+
                                                        '</div>'+
                                                        '</div>'+ 
                                                        '<div class="col-xs-12 col-sm-12 col-md-4">'+
                                                            '<div class="form-group">'+
                                                                '<strong>Quantité Totale:</strong>'+
                                                                '<input type="number" name="qteTotale" class="form-control" placeholder="qteTotale">'+
                                                                '</div>'+
                                                                '</div> '+
                                                                '<div class="col-xs-12 col-sm-12 col-md-4">'+
                                                                    '<div class="form-group">'+
                                                                        '<strong>Prix Total:</strong>'+
                                                                        '<input type="number" name="prixTotal" class="form-control" placeholder="prixTotal">'+
                                                                        '</div>'+
                                                                        '</div>'+ 
                                                                        '</div>'+
                                                                        '</div> '+
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

</script>


@endsection