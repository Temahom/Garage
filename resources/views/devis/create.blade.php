
@extends('layout.index')
@php
	use App\Models\listeproduit;
    $listes=listeproduit::select('categorie')->orderBy('categorie','asc')->distinct()->get();
							
@endphp
@php
    $devis=App\Models\Devi::all();
    $produits=App\Models\Produit::all();
@endphp

@section('content')

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
    <div class="row ml-1">
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
                    <button type="button" class="text-danger" style="border: none; cursor: pointer" data-toggle="modal" data-target="#exampleModal{{ $voiture->id }}">
                        Supprimer
                    </button>
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
</div> <br>

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
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group col-xs-9 col-sm-9 col-md-9">
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
                                            <div class="col-xs-3 col-sm-3 col-md-3" style="width: 10px">
                                                <div class="form-group">
                                                    <strong>Quantité Voulue:</strong>
                                                    <input type="number" name="qteProduit" class="custom-select form-control">
                                                </div>
                                            </div>

                                            <div class="col-xs-3 col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <strong>Devis id:</strong>
                                                            @foreach ($devis as $devi)
                                                                <input class="custom-select form-control" value="{{$devi->id}}" onFocus="this.blur()"/>
                                                            @endforeach
                                                </div>
                                            </div>
                                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                                        <div class="form-group">
                                                            <strong>Panier</strong>
                                                            <button type="submit"  id="btn"class="custom-select form-control btn btn-primary">Ajouter un produit</button>
                                                        </div>
                                                    </div>                                       
                                        </div>
                                    </div>
                                              
                                                  
                
                                </div>                                       
                            </div>
                        </form>
                </div>
                  
            </div>
        </div>
        <style>
            th{
                width: 20%;
                color:rgb(255, 249, 249) !important;
            }
        </style>

        <div class="row">
            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <table class="table table-bordered table-responsive-lg">
                        <tr style="background-color: rgb(49, 158, 86)">
                            <th>Catégorie</th>
                            <th>Libellé</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité</th>
                            <th>Prix total</th>
                        </tr>
                        <tbody id="tableau">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <form action="{{ route('voitures.interventions.devis.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="form-group col-xs-6 col-sm-6 col-md-6">
                                <label for="cout" class="col-form-label">Coût de Réparation</label>
                                <input id="cout" type="number" name="cout" required class="form-control" placeholder="Coût de réparation">
                            </div>
                            <div class="form-group col-xs-6 col-sm-6 col-md-6">
                                <label for="expiration_expiration" class="col-form-label">Date Expiration</label>
                                <input id="expiration" type="date" name="date_expiration" required class="form-control" placeholder="Date expiration...">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>

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
            var category= $('select[name=catProduit]');
            var produit=$('select[name=produit_id]');
            var devis=$('select[name=devis_id]');
            var prix=$('select[name=prix1]');
            var qte=$('input[name=qteProduit]');
            
            $.ajax({
            type: "POST",
            url: "/api/commandes/",
            dataType: 'json',
            data:{"produit_id":produit.val(),"qteProduit":qte.val(),"devi_id":devis.val()},
            success: function(data) {
                console.log(data);
                tcom+=`<tr style="background-color: rgb(185, 206, 192)">
                        <td style="color: black">${data.produits.categorie}</td>
                        <td style="color: black">${data.produits.produit}</td>
                        <td style="color: black">${data.produits.prix1}</td>
                        <td style="color: black">${data.commande.qteProduit}</td>
                        <td style="color: black">${data.produits.prix1*parseInt(data.commande.qteProduit)}<sup> FCFA</sup></td>
                      </tr>`;   
        $('#tableau').html(tcom);
        $('select[name=produit_id]').val("");
        $('input[name=qteProduit]').val("");
            }
                });            
            });    
    }); 
</script>


@endsection