@extends('layout.index')
@php
    $devis=App\Models\Devi::all();
  
    $liste_produits = App\Models\Produit::all();

@endphp

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('commandes.index') }}" title="Aller au panier"> Aller au panier</a>
            </div>
        </div>
    </div><br>

    <form id="formCommande"
    @if (isset($commandes))
      
        action="{{ route('commandes.store') }}" method="POST" 
    @endif
   >
    @csrf
    @if (isset($commandes))
        @method('PUT')
    @endif
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
    <form action="{{ route('commandes.store') }}" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Categorie :</strong>
                    <select name="catProduit" id="categorie" class="custom-select form-control @error('categorie') is-invalid @enderror">
						<option value=""></option>
							@foreach ($produits as $produit)
								<option value="{{$produit->categorie}}">{{$produit->categorie}}</option>
							@endforeach
					</select>		 

                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                <strong>Nom du produit :</strong>
                <select name="produit_id" id="leproduit" class="custom-select form-control @error('produit') is-invalid @enderror">
                    
                </select>	
                </div>		
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Quantité Voulue:</strong>
                    <input type="number" name="qteProduit" class="custom-select form-control">
                </div>
            </div>
             <!--  pluuss--->
            <div class="col-xs-12 col-sm-12 col-md-11">
                <div class="row" >
                    <div class="divCout form-group col-xs-6 col-sm-6 col-md-6">
                        <label for="cout" class="col-form-label">Le Coût </label>
                        <input id="cout" value="{{ isset($commande) ? $commande->cout : '' }}" type="number" min="0" name="cout" class="form-control" placeholder="Coût de la commande">
                    </div>
                    <div class="divDate form-group col-xs-6 col-sm-6 col-md-6">
                        <label for="expiration_expiration" class="col-form-label">Date Expiration</label>
                        <input id="expiration" value="{{ isset($commande) ? $commande->date_expiration : '' }}" type="date" name="date_expiration" class="form-control" placeholder="Date expiration...">
                    </div>
                </div>
            </div>
   <!--         <select name="devis_id" id="categorie" class="custom-select form-control @error('categorie') is-invalid @enderror">
                <option value=""></option>
                    @foreach ($devis as $devi)
                        <option value="{{$devi->id}}">{{$devi->id}}</option>
                    @endforeach
            </select>	 -->
            <div class="col-xs-3 col-sm-3 col-md-3 text-center">
                <div class="form-group">
                    <strong>Panier</strong>
                    <button type="submit"  id="btn"class="custom-select form-control btn btn-primary">Ajouter un produit</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 p-4" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">
                <button type="button" name="add" id="add-btn" class="btn btn-light" style="border-radius:15px">Ajouter un nouveau produit</button>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 pl-0 py-4">
                <a class="btn btn-secondary" href="{{ route('commandes.index')}}">Retour</a>
                <a class="btn btn-success" style="color: white; margin-left: 6px; " onclick="envoyerFormCommande()">Enregistrer</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Catégorie</th>
            <th>Libellé</th>
            <th>Prix Unitaire</th>
            <th>Quantité</th>
            <th>Prix total</th>
        </tr>
        <tbody id="tableau">
            
        </tbody>
    </table>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script>   
        $(document).ready(function() {
            $('select[name=catProduit]').change(function () {
                var produit='<option value="">Nos Produits dispo</option>'
            $.ajax({
                type: "GET",
                url: "/api/produit/"+ $('select[name=catProduit]').val(),
                dataType: 'json',
                success: function(data) {
                    var produits= data;
                    produits.map(p=>{
                    produit+='<option value="'+ p.id+'">'+p.produit+'</option>'
                    
                    })
                    $('#leproduit').html(produit)
                }
                });
            });
            var tcom ="";
            $('#btn').click(function (e) {
                e.preventDefault()
                var produit=$('select[name=catProduit');
                var produit=$('select[name=produit_id]'); 
                var qte=$('input[name=qteProduit]');
                
                $.ajax({
                type: "POST",
                url: "/api/commandes/"+ $('select[name=catProduit]').val()+ $('select[name=catProduit]').val(),
                dataType: 'json',
                data:{"produit_id":produit.val(),"qteProduit":qte.val()},
                success: function(data) {
                    console.log(data);
                    tcom+=`<tr>
                            <td>${data.id}</td>
                            <td>${data.produit_id}</td>
                            <td>${data.qteProduit}</td>
                          </tr>`;   
            $('#tableau').html(tcom);
            $('select[name=produit_id]').val("");
            $('input[name=qteProduit]').val("");
                }
                    });            
                });    
        }); 
   </script>
  <script>
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
            $('#formCommande').submit();
        }
        else{
            alert('Il y\'a un champ vide');
        }
        
        
    }
    /* FIN CONTROL DEVIS*/
 </script>
@endsection