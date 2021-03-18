
@extends('layout.index')
@php
    $liste_produits = App\Models\Produit::all();
@endphp

@section('content')


    <form id="formProd"
        @if (isset($item_devis))
            action="{{ route('voitures.interventions.devis.update',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'devi' => $devi->id]) }}" method="POST"
        @else
            action="{{ route('voitures.interventions.devis.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST"
        @endif
    >
        @csrf
        @if (isset($item_devis))
            @method('PUT')
        @endif


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-11">

                <div class="row" >
                    <div class="divCout form-group col-xs-6 col-sm-6 col-md-6">
                        <label for="cout" class="col-form-label">Coût de Réparation</label>
                        <input id="cout" value="{{ isset($devi) ? $devi->cout : '' }}" type="number" min="0" name="cout" class="form-control" placeholder="Coût de réparation">
                    </div>
                    <div class="divDate form-group col-xs-6 col-sm-6 col-md-6">
                        <label for="expiration_expiration" class="col-form-label">Date Expiration</label>
                        <input id="expiration" value="{{ isset($devi) ? $devi->date_expiration : '' }}" type="date" name="date_expiration" class="form-control" placeholder="Date expiration...">
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
                        @if (isset($item_devis))
                            <?php $i = 0 ?>
                            @foreach ($item_devis as $item_devi)
                                <?php $i++ ?>
                                <div class="row p-3 mb-2" id="newProduit">
                                    <div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">
                                        <span class="numero">#{{ $i }}</span>
                                        <button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>
                                    </div>
                                    <div class="divCategorie col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group catProduit">
                                            <strong>Categorie :</strong>
                                            <select name="produits[{{ $i }}][categorie]" id="categorie" class="custom-select">
                                                <option value="">catégorie</option>
                                                @foreach ($liste_produits as $liste_produit)
                                                    <option value="{{$liste_produit->categorie}}" {{ $liste_produit->id == $item_devi['produit']->id ? 'selected' : '' }}>{{$liste_produit->categorie}}</option>
                                                @endforeach
                                            </select>	 

                                        </div>
                                    </div>
                                    <div class="divProduit col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group select-produit">
                                            <strong>Nom du produit :</strong>
                                            @php
                                                $produits = $item_devi['produit']->produitsByCategorie();
                                            @endphp
                                            <select name="produits[{{ $i }}][id]" id="leproduit" class="custom-select">
                                                <option>produit</option>
                                               @foreach ($produits as $produit))
                                                   <option value="{{ $produit->id }}" {{ $produit->id == $item_devi['produit']->id ? 'selected' : '' }}>{{ $produit->produit }}</option>
                                               @endforeach
                                            </select>	
                                        </div>		
                                    </div>
                                    <div class="divQuantite col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Quantité Voulue:</strong>
                                            <input type="number" min="0" value="{{$item_devi['devi_produit']->quantite}}" name="produits[{{ $i }}][quantite]" class="custom-select form-control">
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
                                        <input type="number" min="0" name="produits[0][quantite]" class="custom-select form-control">
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


<script type="text/javascript">

    function test()
    {
        return '<option>moussa</option>';
    }
   
    function categorieModifier(selectCategorie)
    {
        alert(selectCategorie);
        var produit='<option value="">Produit</option>';
        $.ajax({
            type: "GET",
            url: "/api/produit/"+ selectCategorie,
            dataType: 'json',
            success: function(data) {
                var produits = data;
                produits.map(p=>{
                    produit+='<option value="'+ p.id+'">'+p.produit+'</option>'
                });
                selectCategorie.parents('#newProduit').children('div').children('.select-produit').children('select').html(produit);
              
            }
        });
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
                    '<input type="number" min="0" name="produits['+i+'][quantite]" class="custom-select form-control">'+
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
        if(ok){
            $('#formProd').submit();
        }
        else{
            alert('Il y\'a un champ vide');
        }
        
        
    }
    /* FIN CONTROL DEVIS*/

  


</script>


@endsection