@include('animate_gestion_stock')
@extends('layout.menu')
@php
setlocale(LC_TIME, "fr_FR", "French");
@endphp
@section('content')

<script language="javascript">
    var x =  document.getElementById("#verif");

        if(quantiteStock == 0) {
            x.style.visibility="hidden";
        }
    }
</script>
<style>
    .titre{
            background-image: linear-gradient(to left, #268956, #332F30);
            color:#fff;
            border-radius:20px;
            padding:0 10px;
            padding:10px;
    }
    .label{
        margin-right: 5px;
    }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>
                    <span class="titre"><i class="fas fa-list-ul label"></i>Liste des produits</span>
                </h2>
            </div>
        </div>
    </div>
</div>



@if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$message}}</p>
    </div>
@endif
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
        <div class="col-xs-12 col-sm-12 col-md-12 "><br>
            <div class="card">
                <!--<div class="card-header">
                    <h3 class="mb-0 text-center">La Liste de clients</h3>
                    {{-- <p>This example shows FixedHeader being styled by the Bootstrap 4 CSS framework.</p> --}}
                </div>-->
                <div class="card-body">
                    <div class="table-responsive">
                        @can('create', App\Models\Client::class)
                            <div class="col-xs-12 col-sm-12 col-md-12 row">
                                <div class="col-xs-9 col-sm-9 col-md-9">     
                                    <div class="form-group">
                                        <a class="btn btn-rounded btn-dark" href="{{ route('produits.create') }}" title="Créer produit" style="margin-top: 5px"> 
                                            <i class="fas fa-plus-circle"> Créer Un Produit</i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        <br>
                        <table id="example4" class="table table-striped table-bordered">
                        
                            <thead  class="" style="background-color: #006680;">
                                <tr>
                                    <th style="color: white; width: 3%" style="cursor: pointer;">N°</th>
                                    <th style="color: white;" style="cursor: pointer;">Catégorie</th>
                                    <th style="color: white;" style="cursor: pointer;">Nom du Produit</th>
                                    <th style="color: white;" style="cursor: pointer;">Prix Unitaire (F CFA)</th>
                                    <th style="color: white;" style="cursor: pointer;">Stock d'Alerte</th>
                                    <th style="color: white; text-align: center;" style="cursor: pointer; ">En Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produits as $i=>$produit)
                                <tr>
                                    <td onclick="editProduit({{ $produit->id }})">{{ ++$i }}</td>
                                    <td onclick="editProduit({{ $produit->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $produit->categorie }}</td>
                                    <td onclick="editProduit({{ $produit->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $produit->produit }}</td>
                                    <td onclick="editProduit({{ $produit->id }})" style="cursor: pointer;">{{number_format($produit->prix1 ,0, ",", " " )}} </td>
                                    <td onclick="editProduit({{ $produit->id }})" style="cursor: pointer; text-align: center">{{$produit->quantite_alert}}</td>   
                                    <td onclick="editProduit({{ $produit->id }})" style="cursor: pointer; text-align: center">{{$produit->qte}}</td>   
                                    {{-- <td style="text-transform:capitalize;"> {{strftime("%A %d %B %Y", strtotime($produit->created_at))}}</td> --}}
                                    <!--  <td style="text-align:center !important">    
                                        <a href="{{ route('produits.edit', $produit->id) }}">
                                            <i class="fas fa-edit  fa-lg"></i>
                                        </a>
                                        <a data-toggle="modal" id="smallButton{{$produit->id}}" data-target="#smallModal{{$produit->id}}" data-attr="{{ route('produits.destroy', $produit->id) }}" title="Supprimer Produit">
                                            <i class="fas fa-trash text-danger  fa-lg"></i>
                                        </a>
                                            <!-- small modal 
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
                                                                <form action="/produits/{{$produit->id}}" method="POST">
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
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    </td>-->
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
 
  


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

    <script>
        function editProduit(id)
        {
            window.location = 'produits/' + id + '/edit';
        }
    </script>

<script>
  const compare = (ids, asc) => (row1, row2) => {
      const tdValue = (row, ids) => row.children[ids].textContent;
      const tri = (v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
      return tri(tdValue(asc ? row1 : row2, ids), tdValue(asc ? row2 : row1, ids));
  };
      const tbody = document.querySelector('tbody');
      const thx = document.querySelectorAll('th');
      const trxb = tbody.querySelectorAll('tr');

      thx.forEach(th => th.addEventListener('click', () => {
          let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
          classe.forEach(tr => tbody.appendChild(tr));
      }));

</script>

<script>
    function verif() {
            if ($quantiteStock = 0) {
                document.getElementById('verif').style.display = 'none';
            }  
            };
</script>


@endsection



        <!-- ============================================================== 
////Vente(produits qui sont dans devi) 
/*     $vente=\App\Models\Devi_produit::select("produit_id,quantite")->where('produit_id','*','quantite');
$deviProduitMois=\App\Models\Devi_produit::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('produit_id');
      ///
$deviProduitJour=\App\Models\Devi_produit::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->sum('produit_id');
-->