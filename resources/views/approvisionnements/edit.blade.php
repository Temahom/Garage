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
                   <span class="titre"> <i class="far fa-edit label"></i>Modification Approvisionnement</span> 
                </h2>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 25px;">
        <form action="{{ route('approvisionnements.update', $approvisionnement->id) }}" method="POST">
            @csrf
            @method('PUT')
        
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
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
                                <input type="date" name="date_approvisionnement" class="form-control">
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
                            @if (isset($item_produits))
                            <?php $i = 0 ?>
                            @foreach ($item_produits as $item_produit)
                                <?php $i++ ?>

                                <div class="row p-3 mb-2" id="newproduct">
                                    <div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">
                                        <span class="numero">#1</span>
                                        <button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">
                                        <div class="row">
                                            <div class="divProduit col-xs-12 col-sm-12 col-md-4">
                                                <strong>Nom Produit</strong>
                                                    <select name="plusdechamps[0][produit_id]" class="custom-select form-control" >
                                                        <option value="">Nom Produit</option>
                                                            @foreach( $produits as $produit ) 
                                                                <option value="{{$produit->id}}">{{ $produit->produit }}</option>
                                                            @endforeach 
                                                    </select>
                                            </div> 
                                            <div class="divQteAppro col-xs-12 col-sm-12 col-md-4">
                                                <strong>Quantité Approvisionnée:</strong>
                                                <input type="number" name="plusdechamps[0][qteAppro]" class="form-control" placeholder="Quantité Approvisionnée">
                                            </div> 
                                            <div class="divPuAchat col-xs-12 col-sm-12 col-md-4">
                                                <strong>PU achat:</strong>
                                                <input type="number" name="plusdechamps[0][prixAchat]" class="form-control" placeholder="Prix Unitaire (achat)">
                                            </div> 
                                        </div>
                                    </div> 
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        
        </form>
    </div>
</div>
<br>




<script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
@endsection