@extends('layout.index')
@section('content')
 
<div class="row ml-1">
    <div class="col-md-5 py-5"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
        <div class="row">

            <div class="col-md-2 col-sm-3 text-center pt-2">
                    <i style="height: 50px;width: auto;" class="fas fa-briefcase"></i>  
            </div>

            <div class="col-md-10 col-sm-10">
                <div style="font-size: 20px; ">Produit : <a href="{{route('produits.index',['produit'=>$produit->id])}}" style="color: #2EC551">{{ $produit->produit}} </a></div>
                <div style="font-size: 14px; ">Catégorie  : <a href="{{route('produits.index',['produit'=>$produit->id])}}" style="color: #750439">{{ $produit->categorie}} </a></div>
                <div style="font-size: 14px;" >Prix Unitaire  : <a href="" class="badge badge-success"> {{ $produit->prix1}} <sup>F CFA</sup> </a> </div>
                <div style="font-size: 14px;">Quantité Produit  : {{ $produit->qte}}</div>
                <div class="text-right" style="font-size: 12px;"  title="Modifier Produit">
                    <a href="{{ route('produits.edit', $produit->id) }}">
                        <i class="fas fa-edit  fa-lg"></i>
                    </a>
                    <a data-toggle="modal" id="smallButton{{$produit->id}}" data-target="#smallModal{{$produit->id}}" data-attr="{{ route('produits.destroy', $produit->id) }}" title="Supprimer Produit">
                        <i class="fas fa-trash text-danger  fa-lg"></i>
                    </a>

                    <div class="modal fade" id="smallModal{{$produit->id}}" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body" id="smallBody">
                                  <div>
                                      <!-- the result to be displayed apply here    <form action="/produits/{{$produit->id}}" method="POST"> --> 
                                      <form action="{{ route('produits.destroy', $produit->id) }}" method="POST">
                                      <div class="modal-body">
                                          @csrf
                                          @method('DELETE')
                                          <h5 class="text-center">Etes-vous sûr que vous voulez supprimer le Produit :{{ $produit->produit }} ? </h5>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button"  title="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                          <button type="submit"  title="delete" class="btn btn-danger">Oui,Supprimer</button>
                                      </div>
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
</div>


@endsection