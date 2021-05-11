
    @extends('layout.menu') 
    @php
        use App\Models\Produit;
        $listes=Produit::select('produit')->orderBy('produit','asc')->distinct()->get();							
    @endphp 
    
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
    <br>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2><i>Liste des Approvisionnements</i></h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-rounded btn-dark" href="{{ route('fournisseurs.approvisionnements.create',['fournisseur'=>$fournisseur]) }}" title="Create a project"> <i class="fas fa-plus-circle"> Ajouter</i>
                        </a>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row">  
            <div class="col-xs-12 col-sm-12 col-md-12 ">  
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr style="background-color: #006680;">
                                        <th scope="col" style="color: #ffffff; text-align:center; width: 5%" >N°</th>
                                        <th scope="col" style="color: #ffffff;text-align:center;" >Date approvisionnement</th>
                                        <th scope="col" style="color: #ffffff;text-align:center;" >Nombre d'article(s)</th>
                                        <th scope="col" style="color: #ffffff;text-align:center;" >Montant Facturé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approvisionnements as $key=>$appro)
                                        <tr>
                                            <td style="text-align: center;cursor: pointer;" onclick="showAppro({{ $appro->id }})">{{++$key}}</td>
                                            <td style="text-align: center;cursor: pointer;" onclick="showAppro({{ $appro->id }})">{{date("d-m-Y", strtotime($appro->date_approvisionnement))}}</td>
                                            <td style="text-align: center;cursor: pointer;" onclick="showAppro({{ $appro->id }})">{{count($appro->produits)}}</td>
                                            @php
                                            $prix_tt= 0;
                                            foreach ($appro->produits as $produit) {
                                                $prix_tt += $produit->pivot->prix_achat*$produit->pivot->quantite;
                                            }
                                            $prix_tt;
                                            @endphp
                                            <td style="text-align: center;cursor: pointer;" onclick="showAppro({{ $appro->id }})">{{$prix_tt}} fcfa</td>
                                        </tr>
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
    <script>
		function showAppro(id)
		{
			window.location = '/approvisionnements/' + id ;
		}
	</script>
   
    @endsection