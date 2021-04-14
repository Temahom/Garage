@extends('layout.index')
@section('content')



    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">  
            <div class="col-md-4 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
                <div class="row">
                    <div class="col-md-2 col-sm-3 text-center pt-4">
                        @if ($fournisseur->genre == "homme")
                            <img style="height: 50px;width: auto;" class="" src="/assets/images/masculin.png" alt="logo">
                        @else
                            <img style="height: 50px;width: auto;" class="" src="/assets/images/feminin.png" alt="logo">
                        @endif
                    </div>

                    <div class="col-md-10 col-sm-10">
                        <div style="font-size: 20px; color: #2EC551"><a href="{{route('fournisseurs.show',['fournisseur'=>$fournisseur->id])}}" style="color: #2EC551">{{ $fournisseur->prenom}}  {{ $fournisseur->nom}}</a></div>
                        <div style="font-size: 14px;"><i class="fas fa-home"></i> {{ $fournisseur->entreprise}}</div>
                        <div style="font-size: 14px;"><i class="fas fa-phone"></i> {{ $fournisseur->telephone}}</div>
                        <div style="font-size: 14px;"><i class="fas fa-envelope"></i> {{ $fournisseur->email}}</div>
                        @can('update', $fournisseur)
                        <div class="text-right" style="font-size: 12px;">
                            <a class="text-primary mr-1" href="{{ route('fournisseurs.edit',$fournisseur->id)}}">Modifier</a> 
                            <button type="button" class="text-danger hide_delete" id="hide_fournisseurs" style="border: none; cursor: pointer" data-toggle="modal" data-target="#exampleModal{{ $fournisseur->id }}">
                                Supprimer
                            </button>
        
                                    <div class="modal fade" id="exampleModal{{ $fournisseur->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h5>Voulez vous supprimer: <strong>{{ $fournisseur->nom }} {{ $fournisseur->prenom }}</strong>  ?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <form action="{{route('fournisseurs.destroy',$fournisseur->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        @endcan
                    </div>

                </div>
            </div>
        </div>
    </div>
    
  
                

    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  

    <div class="col-lg-12 margin-tb">
        <div class="col-xs-12 col-sm-12 col-md-12 row">
            <div class="col-xs-9 col-sm-9 col-md-9">     
                <div class="pull-right py-3">
                    <a class="btn btn-secondary" href="{{route('fournisseurs.approvisionnements.create',['fournisseur'=>$fournisseur->id])}}"><i class="fas fa-plus"></i> Nouveau Approvisionnement</a>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">     
        </div></div>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">
          
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example4" class="table  table-striped table-bordered" style="width:100%">
                <thead class="" style="background-color: #4656E9;">
                    <tr>
                        <th style="color: white;">Nom du Produit</th>
                        <th style="color: white;">Quantité Totale</th>
                        <th style="color: white;">Prix Total</th>
                        <th style="color: white;">Date d'entrée</th>
                        <th style="color: white; text-align: center">Action</th>
                    </tr>
                </thead>
                @foreach ($approvisionnements as $approvisionnement)
                <tr>
                    <td>{{ $approvisionnement->nomProduit}}</td>
                    <td>{{ $approvisionnement->qteTotale}}</td>
                    <td>{{ $approvisionnement->prixTotal}}</td>
                    <td>{{ $approvisionnement->created_at}}</td>
                    <td style="color: white; text-align: center">
                        <form action="{{ route('approvisionnements.destroy', $approvisionnement->id) }}" method="POST">

                         <!--   <a href="{{ route('approvisionnements.show', $approvisionnement->id) }}" title="show">
                                <i class="fas fa-eye text-success  fa-lg"></i>
                            </a> -->

                            <a href="{{route('fournisseurs.approvisionnements.create',['fournisseur'=>$fournisseur->id])}}">
                                <i class="fas fa-edit  fa-lg"></i>

                            </a>

                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-danger p-0 pr-2 pl-2 " data-toggle="modal" data-target="#exampleModal{{ $approvisionnement->id }}" onclick="OnOff();">
                                <i class="fas fa-trash"></i>
                            </button>

                                    <div class="modal fade" id="exampleModal{{ $approvisionnement->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h5>Voulez vous supprimer </h5>
                                                    <h5>l'Approvisionnement de <strong>{{ $approvisionnement->nomProduit}}</strong></h5>
                                                    <h5>Quantité Totale : <strong>{{ $approvisionnement->qteTotale}}</strong> | Prix Total : <strong>{{ $approvisionnement->prixTotal}} cfa</strong></h5>
                                                    <h5> du fournisseur <strong>{{ $approvisionnement->fournisseur()->first()->prenom }} {{ $approvisionnement->fournisseur()->first()->nom }}</strong>  ?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <form action="{{route('approvisionnements.destroy',$approvisionnement->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                        </form>
                    </td>
                </tr>
                    
                @endforeach
            </table>
            </div>
        </div>
        </div>
         </div>
         </div>
         
        <div class="row">
            <div class="col-md-12 ml-3 mt-3">
                <a class="btn btn-secondary" href="{{ route('fournisseurs.index') }}"><i class="fas fa-angle-left"></i> Retour</a>
            </div>
         </div>
           
    </div></div></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

	<script>
		function showApprovisionnement(id)
		{
			window.location = '/approvisionnements/' + id ;
		}
	</script>
@endsection