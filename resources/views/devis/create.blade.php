
@extends('layout.index')
@php
    $liste_produits = App\Models\Produit::all();
@endphp

@section('content')


    <div class="row ml-1 mb-5">
        <div class="col-md-5 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
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
    
                    <div style="font-size: 14px;"> {{ $voiture->marque}} - {{ $voiture->model}} - {{ $voiture->annee}}</div>
                    <div style="font-size: 14px;"> {{ $voiture->transmission}} - {{ $voiture->carburant}}</div>			
                    <div style="font-size: 14px;"> {{ $voiture->puissance}} cheveaux - {{ $voiture->kilometrage}} km</div>		
                    <div class="text-right" style="font-size: 12px;">
                        <a class="text-primary mr-1" href="{{ route('voitures.edit',$voiture->id)}}">Modifier</a> 
                        <button type="button" class="text-danger" style="border: none; cursor: pointer" data-toggle="modal" data-target="#exampleModal{{ $voiture->id }}">Supprimer</button>
                        <div class="modal fade" id="exampleModal{{ $voiture->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5>Voulez vous supprimer : <strong>{{ $voiture->matricule }}</strong>  ?</h5>
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

    
    <form id="formProd" action="{{ route('voitures.interventions.devis.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-11">

                <div class="row" >
                    <div class="divCout form-group col-xs-6 col-sm-6 col-md-6">
                        <label for="cout" class="col-form-label">Coût de Réparation</label>
                        <input id="cout" type="number" name="cout" class="form-control" placeholder="Coût de réparation">
                    </div>
                    <div class="divDate form-group col-xs-6 col-sm-6 col-md-6">
                        <label for="expiration_expiration" class="col-form-label">Date Expiration</label>
                        <input id="expiration" type="date" name="date_expiration" class="form-control" placeholder="Date expiration...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                        <strong>Produit:</strong>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12" id="dynamicAddRemove">
                        <style>
                            #newProduit
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
                        @if (isset($produits))
                            @foreach ($produits as $produit)
                                <div class="row p-3 mb-2" id="newProduit">
                                    <div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">
                                        <span class="numero">#1</span>
                                        <button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>
                                    </div>
                                    <div class="divCategorie col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group catProduit">
                                            <strong>Categorie :</strong>
                                            <select name="produits[0][categorie]" id="categorie" class="custom-select">
                                                <option value="">catégorie</option>
                                                @foreach ($liste_produits as $liste_produit)
                                                    <option value="{{$liste_produit->categorie}}" {{ $liste_produit->id == $produit->id ? 'selected' : '' }}>{{$liste_produit->categorie}}</option>
                                                @endforeach
                                            </select>		 

                                        </div>
                                    </div>
                                    <div class="divProduit col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group select-produit">
                                            <strong>Nom du produit :</strong>
                                            <select name="produits[0][id]" id="leproduit" class="custom-select">
                                                <option value="">---</option>
                                            </select>	
                                            <script>
                                                listeProduit();
                                            </script>
                                        </div>		
                                    </div>
                                    <div class="divQuantite col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Quantité Voulue:</strong>
                                            <input type="number" name="produits[0][quantite]" class="custom-select form-control">
                                        </div>
                                    </div>
                                                                            
                                </div>
                            @endforeach
                        @else
                            <div class="row p-3 mb-2" id="newProduit">
                                <div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">
                                    <span class="numero">#1</span>
                                    <button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>
                                </div>
                                <div class="divCategorie col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group catProduit">
                                        <strong>Categorie :</strong>
                                        <select name="produits[0][categorie]" id="categorie" class="custom-select">
                                            <option value="">catégorie</option>
                                            @foreach ($liste_produits as $liste_produit)
                                                <option value="{{$liste_produit->categorie}}">{{$liste_produit->categorie}}</option>
                                            @endforeach
                                        </select>		 

                                    </div>
                                </div>
                                <div class="divProduit col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group select-produit">
                                        <strong>Nom du produit :</strong>
                                        <select name="produits[0][id]" id="leproduit" class="custom-select">
                                            <option value="">---</option>
                                        </select>	
                                    </div>		
                                </div>
                                <div class="divQuantite col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>Quantité Voulue:</strong>
                                        <input type="number" name="produits[0][quantite]" class="custom-select form-control">
                                    </div>
                                </div>
                                                                        
                            </div>
                        @endif

                        
                                


                    </div>                                       
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 p-4" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">
                        <button type="button" name="add" id="add-btn" class="btn btn-light" style="border-radius:15px">Ajouter un nouveau produit</button>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 pl-0 py-4">
                        <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
                        <a class="btn btn-success" style="color: white; margin-left: 6px; " onclick="envoyerFormProd()">Enregistrer</a>
                    </div>
                </div>

            </div>
        </div>
    </form>     

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
   
<script>   

    function listeProduit()
    {
        return "<?php echo 'moussa thiam' ?>";
    }


    $(document).on('change', '.catProduit select', function(){ 
        var selectCategorie = $(this);
        var produit='<option value="">Produit</option>';
        $.ajax({
            type: "GET",
            url: "/api/produit/"+ selectCategorie.val(),
            dataType: 'json',
            success: function(data) {
                var produits= data;
                produits.map(p=>{
                    produit+='<option value="'+ p.id+'">'+p.produit+'</option>'
                });
                selectCategorie.parents('#newProduit').children('div').children('.select-produit').children('select').html(produit);
              
            }
        });
    });

    var i = 1000;
    var divDevis;

    function getDiv(i){
        divDevis = '<div class="row p-3 mb-2" id="newProduit">'+
            '<div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">'+
                '<span class="numero"></span>'+
                '<button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>'+
            '</div>'+
            '<div class="divCategorie col-xs-4 col-sm-4 col-md-4">'+
                '<div class="form-group catProduit">'+
                    '<strong>Categorie :</strong>'+
                    '<select name="produits['+i+'][categorie]" id="categorie" class="custom-select">'+
                        '<option value="">catégorie</option>'+
                        '@foreach ($liste_produits as $liste_produit)'+
                            '<option value="{{$liste_produit->categorie}}">{{$liste_produit->categorie}}</option>'+
                        '@endforeach'+
                    '</select>'+
                '</div>'+
            '</div>'+
            '<div class="divProduit col-xs-4 col-sm-4 col-md-4">'+
                '<div class="form-group select-produit">'+
                    '<strong>Nom du produit :</strong>'+
                    '<select name="produits['+i+'][id]" class="custom-select">'+
                        '<option value="">---</option>'+
                    '</select>'+
                '</div>'+
            '</div>'+
            '<div class="divQuantite col-xs-4 col-sm-4 col-md-4">'+
                '<div class="form-group">'+
                    '<strong>Quantité Voulue:</strong>'+
                    '<input type="number" name="produits['+i+'][quantite]" class="custom-select form-control">'+
                '</div>'+
            '</div>'+                           
        '</div>';
        return divDevis;
    }

    $("#add-btn").click(function(){
        div = getDiv(i);
        $("#dynamicAddRemove").append(div);
        numeroter();
        i++;
    });

    $(document).on('click', '#remove-button', function(){  
        $(this).parents('#newProduit').remove();
        numeroter();
    });

    function numeroter() {
        var num = 1;
        $('#dynamicAddRemove > div').each( function(){
            $(this).children('.divSup').children('.numero').text('#' + num);
            num++;
        });
    }

/*CONTROL DEVIS*/
    function envoyerFormProd()
    {
    
        var ok = 1;
        cout = $('#cout').val().trim();
        $('#cout').removeClass( "is-invalid" );
        if(cout == '')
        {
            $('#cout').addClass( "is-invalid" );
            ok = 0;
        }

        expiration = $('#expiration').val().trim();
        $('#expiration').removeClass( "is-invalid" );
        if(expiration == '')
        {
            $('#expiration').addClass( "is-invalid" );
            ok = 0;
        }
        
        
        $('#dynamicAddRemove > div').each( function(){
            $(this).children('.divCategorie').children('.catProduit').children('select').removeClass('is-invalid');
            $(this).children('.divProduit').children('.select-produit').children('select').removeClass('is-invalid');
            $(this).children('.divQuantite').children('div').children('input').removeClass('is-invalid');
           

            categorie = $(this).children('.divCategorie').children('.catProduit').children('select').val().trim();
            produit = $(this).children('.divProduit').children('.select-produit').children('select').val().trim();
            quantite = $(this).children('.divQuantite').children('div').children('input').val().trim();
            

            if(categorie == '')
            {
                $(this).children('.divCategorie').children('.catProduit').children('select').addClass('is-invalid');
                ok = 0;
            }
            if(produit == '')
            {
                $(this).children('.divProduit').children('.select-produit').children('select').addClass('is-invalid');
                ok = 0;
            }
            if(quantite == '')
            {
                $(this).children('.divQuantite').children('div').children('input').addClass('is-invalid');
                ok = 0;
            }
        });
        if(ok)
        $('#formProd').submit();
    }
    /* FIN CONTROL DEVIS*/

  


</script>


@endsection