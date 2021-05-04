@extends('layout.menu')
  
@section('content')

<style>
    .titre{
            background-image: linear-gradient(to left, #268956, #332F30);
            color:#fff;
            border-radius:20px;
            padding:0 10px;
            padding:15px;
    }
    .label{
        margin-right: 5px;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>
                    <span class="titre"><i class="far fa-edit label"></i>Modification Approvisionnement</span>
                </h2>
            </div>
        </div>
    </div>
</div>
<br>
<form id="Formapprov" action="{{ route('approvisionnements.update',[$approvisionnement->id]) }}" method="POST">
    @csrf
    @method('PUT')
    
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-11" >
                <div class="row p-3" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">    
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                        <div class="form-group">
                            <strong>Fournisseur</strong>
                            <select name="fournisseur_id" class="custom-select form-control" >
                                @if(!empty($fournisseur->id))
                                    <option value="{{$fournisseur->id}}">{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                @else   
                                    @foreach( $fournisseurs as $fournisseur ) 
                                        <option value="{{$fournisseur->id}}" {{ old('fournisseur_id') == ($fournisseur->id) ? 'selected' : '' }} {{$approvisionnement->fournisseur_id == $fournisseur->id ? 'selected':'' }}>{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                    @endforeach 
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                        <div class="form-group">
                            <strong>Date Approvisionnement</strong>
                            <input type="date" name="date_approvisionnement" class="form-control" value="{{ $approvisionnement->date_approvisionnement}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                        <strong>Produit(s):</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12" id="dynamicAddRemove">
                        <style>
                            #newproduct
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
                        
                        @php  $i = 0; @endphp
                        @foreach ($approvisionnement->produits as $product)
                            @php  $i++; @endphp
                            <!-- AJOUT MODIFICATION PRODUITS -->
                            <div class="row p-3 mb-2" id="newproduct">
                                <div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">
                                    <span class="numero">#{{ $i }}</span>
                                    <button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">
                                    <div class="row">
                                        <div class="divProduit col-xs-12 col-sm-12 col-md-4">
                                            <strong>Nom Produit</strong>
                                            
                                                <select name="plusdechamps[{{ $i }}][produit_id]" class="custom-select form-control" >
                                                    <option value="">Nom Produit</option>
                                                        @foreach( $produits as $produit ) 
                                                            <option value="{{ $produit->id }}"  {{ $produit->id == $product->id ? 'selected' : '' }}>{{ $produit->produit }}</option>
                                                        @endforeach 
                                                </select>
                                        </div> 
                                        <div class="divQteAppro col-xs-12 col-sm-12 col-md-4">
                                            <strong>Quantité Approvisionnée:</strong>
                                            <input value="{{ $product->pivot->quantite}}" type="number" name="plusdechamps[{{ $i }}][qteAppro]" class="form-control" placeholder="Quantité Approvisionnée">
                                        </div> 
                                        <div class="divPuAchat col-xs-12 col-sm-12 col-md-4">
                                            <strong>PU achat:</strong>
                                            <input value="{{ $product->pivot->prix_achat}}" type="number" name="plusdechamps[{{ $i }}][prixAchat]" class="form-control" placeholder="Prix Unitaire (achat)">
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                            <!-- FIN MODIFICATION PRODUITS -->
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 p-4" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">
                        <button type="button" name="add" id="add-btn" class="btn btn-light" style="border-radius:15px">Ajouter un nouveau produit</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12 pl-0 py-4">
                <a class="btn btn-rounded btn-secondary" href="{{ route('approvisionnements.index') }}" title="Go back"> <i class="fas fa-backward "></i> Retour</a>
                <a class="btn btn-rounded btn-success" style="color: white; margin-left: 6px; " onclick="envoyerFormappro()">Enregistrer</a>
            </div>
        </div>
            
</form>



{{-- <script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script> --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<script  type="text/javascript">
    var i = 1000;
    var nbItemApprov = 1;
    var divApprov;

    function getDiv(i) {
        divApprov =     '<div class="row p-3 mb-2" id="newproduct">'+
                                    '<div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">'+
                                        '<span class="numero"></span>'+
                                        '<button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>'+
                                    '</div>'+
                                    '<div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">'+
                                        '<div class="row">'+
                                            '<div class="divProduit col-xs-12 col-sm-12 col-md-4">'+
                                                '<strong>Nom Produit</strong>'+
                                                    '<select name="plusdechamps['+i+'][produit_id]" class="custom-select form-control" >'+
                                                        '<option value="">Nom Produit</option>'+
                                                            '@foreach( $produits as $produit )'+
                                                                '<option value="{{$produit->id}}">{{ $produit->produit }}</option>'+
                                                            '@endforeach'+
                                                    '</select>'+
                                            '</div>'+
                                            '<div class="divQteAppro col-xs-12 col-sm-12 col-md-4">'+
                                                '<strong>Quantité Approvisionnée:</strong>'+
                                                '<input type="number" name="plusdechamps['+i+'][qteAppro]" class="form-control" placeholder="Quantité Approvisionnée">'+
                                            '</div>'+
                                            '<div class="divPuAchat col-xs-12 col-sm-12 col-md-4">'+
                                                '<strong>PU achat:</strong>'+
                                                '<input type="number" name="plusdechamps['+i+'][prixAchat]" class="form-control" placeholder="Prix Unitaire (achat)">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+ 
                                '</div>';
        return divApprov;
    }

    

    $("#add-btn").click(function(){
        div = getDiv(i);
        $("#dynamicAddRemove").append(div);
        numeroter();
        i++;
    });

    $(document).on('click', '#remove-button', function(){  
        $(this).parents('#newproduct').remove();
        numeroter();
    });

    function numeroter() {
        var num = 0;
        $('#dynamicAddRemove > div').each( function(){
            num++;
            $(this).children('.divSup').children('.numero').text('#' + num);
        });
        nbItemApprov = num;
    }

    $(document).on('change', function(){  
        var parent = $(this).parents('#newproduct');
        $.ajax({
            
            success: function(data) {
                parent.children('div').children('div').children('.divQteAppro').children('input').removeClass('is-invalid');
                parent.children('div').children('div').children('.divPuAchat').children('input').removeClass('is-invalid');
                
                parent.children('div').children('div').children('.divQteAppro').children('input').val(data[0].divQteAppro);
                parent.children('div').children('div').children('.divPuAchat').children('input').val(data[0].divPuAchat);
            }
        });
    });

    /*DEBUT control formulaire*/
    function envoyerFormappro()
    {
       
        var ok = 1;
        
        if(nbItemApprov == 0)
        {
            alert('Ajouter au moins un produit');
            return 0;
        }
        $('#dynamicAddRemove > div').each( function(){
            $(this).children('div').children('div').children('.divProduit').children('select').removeClass('is-invalid');
            $(this).children('div').children('div').children('.divQteAppro').children('input').removeClass('is-invalid');
            $(this).children('div').children('div').children('.divPuAchat').children('input').removeClass('is-invalid');
            
            Produit = $(this).children('div').children('div').children('.divProduit').children('select').val().trim();
            
            if(Produit == '')
            {
                $(this).children('div').children('div').children('.divProduit').children('input').addClass('is-invalid');
                ok = 0;
            }

            QteAppro = $(this).children('div').children('div').children('.divQteAppro').children('input').val().trim();

            if(QteAppro == '')
            {
                $(this).children('div').children('div').children('.divQteAppro').children('input').addClass('is-invalid');
                ok = 0;
            }

            PuAchat = $(this).children('div').children('div').children('.divPuAchat').children('input').val().trim();

            if(PuAchat == '')
            {
                $(this).children('div').children('div').children('.divPuAchat').children('input').addClass('is-invalid');
                ok = 0;
            }
        });
        if(ok){
            $('#Formapprov').submit();
        }
        else{
            alert('il y\'a au moins un champs vide');
        }
    }
    /*FIN control formulaire*/
    

</script>
@endsection