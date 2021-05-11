
@include('animate_gestion_stock')
@extends('layout.menu')
@php
setlocale(LC_TIME, 'fr_FR', 'French');
$date = new DateTime('now', new DateTimeZone('UTC'));

use Carbon\Carbon;
use App\Models\Devi;
use App\Models\Devi_produit;
use App\Models\Produit;
use App\Models\Dashboard_stock;
use App\Models\Approvisionnement;
use App\Models\Fournisseur;

$devi_produits = Devi_produit::all();

$produits_vendus = Devi_produit::sum('quantite');

$produits = Produit::all();
$produit_total = \App\Models\Produit::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->count();

$produit_en_stock = \App\Models\Produit::select('qte')
    ->where('qte', '>', 0)
    ->count();	
    
// $produit_en_appro = \App\Models\Approvisionnement::sum('qteAppro');
// $prix_en_appro = \App\Models\Produit::sum('prix1');


/*$mois_ci = Carbon::now()->format('F');
$jour_ci = Carbon::now()->day;  */ 		
////////////////////////////////////*********************////////////////////////////////////////////////////

 //Calcul DU NOMBRE DE PRODUITS QUI SONT DANS LE DEVIS(produit commandés pour linstant)
  function listeProduitDansDevi()
    {
        $listeProduitDevi = 0;
       $devi_produits = Devi_produit::all();
        foreach ($devi_produits as  $devi_produit) {
            if($devi_produit->produit_id )
            {
                $listeProduitDevi = $listeProduitDevi + 1;
                
            }
        }
        return $listeProduitDevi;
    }
//////////AFFICHAGE DU TABLEAU DES PRODUITS QUI SONT DANS DEVIS

$commandes = \App\Models\Commande::all();

setlocale(LC_TIME, 'fr_FR', 'French');
$date = new DateTime('now', new DateTimeZone('UTC'));
$clients = \App\Models\Client::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->count();
$chiffres = \App\Models\Devi::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->sum('cout');
$produit_en_stock = \App\Models\Produit::select('qte')
    ->where('qte', '>', 0)
    ->count();
$produit_total = \App\Models\Produit::sum('qte');
$prix_total_des_produits = \App\Models\Produit::sum('prix1');
$client30 = \App\Models\Client::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month - 1)
    ->count();
$chiffre30 = \App\Models\Devi::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month - 1)
    ->sum('cout');

$client60 = \App\Models\Client::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month - 2)
    ->count();
$chiffre60 = \App\Models\Devi::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month - 2)
    ->sum('cout');
$total = $chiffres + $chiffre30 + $chiffre60;
//*************Ventes et Factures
$facturesMois = \App\Models\Facture::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->count();
//facture aujourd"hui
$facturesJour = \App\Models\Facture::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->whereDay('created_at', Carbon::now()->day)
    ->count();
///Tab Recapitulatif Mensuel de diagnostic,Devis et Interventions
$diagnostics = \App\Models\Diagnostic::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->count();
$devis = \App\Models\Devi::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->count();
$interventions = \App\Models\Intervention::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->count();
$mois_ci = Carbon::now()->format('F');
$voitures = \App\Models\Voiture::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->count();
///Tab Recapitulatif Journaliere
$jour_ci = Carbon::now()->day;
//VOITURE EN GARAGE
$interventionVoitureEnGarages = \App\Models\Dashboard::interventionVoitureEnGarages();
//TABLEAU RECAPTULATIF DES JOURS
$tabRecupDays = \App\Models\Dashboard::tabRecupDays();
//TABLEAU RECAPTULATIF MOIS
$tabRecupMonths = \App\Models\Dashboard::tabRecupMonths();
//TABLEAU RECAPTULATIF CE MOIS
$tabThisMonth = \App\Models\Dashboard::tabThisMonth();


@endphp

@section('content')
 
<style>
body, html {
	height:100%;
  }
  
  /*
   * Off Canvas sidebar at medium breakpoint
   * --------------------------------------------------
   */
  @media screen and (max-width: 992px) {
  
	.row-offcanvas {
	  position: relative;
	  -webkit-transition: all 0.25s ease-out;
	  -moz-transition: all 0.25s ease-out;
	  transition: all 0.25s ease-out;
	}
  
	.row-offcanvas-left
	.sidebar-offcanvas {
	  left: -33%;
	}
  
	.row-offcanvas-left.active {
	  left: 33%;
	  margin-left: -6px;
	}
  
	.sidebar-offcanvas {
	  position: absolute;
	  top: 0;
	  width: 33%;
	  height: 100%;
	}
  }
  
  /*
   * Off Canvas wider at sm breakpoint
   * --------------------------------------------------
   */
  @media screen and (max-width: 34em) {
	.row-offcanvas-left
	.sidebar-offcanvas {
	  left: -45%;
	}
  
	.row-offcanvas-left.active {
	  left: 45%;
	  margin-left: -6px;
	}
	
	.sidebar-offcanvas {
	  width: 45%;
	}
  }
  
  .card {
	  overflow:hidden;
  }
  
  .card-body .rotate {
	  z-index: 8;
	  float: right;                       
	  height: 100%;
  }                                  

  .card-body .rotate i {
	  color: rgba(20, 20, 20, 0.15);
	  position: absolute;
	  left: 0;
	  left: auto;
	  right: -10px;
	  bottom: 0;
	  display: block;
	  -webkit-transform: rotate(-44deg);
	  -moz-transform: rotate(-44deg);
	  -o-transform: rotate(-44deg);
	  -ms-transform: rotate(-44deg);
	  transform: rotate(-44deg);
  }
  
</style>
@php
  
                                    
    $devis=Devi::with('produits')->whereMonth('created_at',Carbon::now()->month)->get();
    $prixR=0;
    foreach ($devis as $devi) {
        $produits=$devi->produits()->get();
        foreach ($produits as $produit){

            $prixR+=$produit->prix1*$produit->pivot->quantite;
        }
    }  
                                 
    $devis=Devi::all();
    $commandes=\App\Models\Commande::all();

    $total=0;

    foreach ($devis as $devi) {
        $commandes=$devi->commande()->get();
        $devips=$devi->devi_produits()->get();
        foreach ($devips as $devip){
            foreach ($commandes as $commande){
                if($devip->devi_id == $commande->devi_id){
                    if($commande->etat==2){
                        $total+=$devip->quantite;
                    }
                }
            }
        }  
    }                           
@endphp


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 row">  
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-white" style="background-image: linear-gradient( to top,#CBDD22, #839603);">
                        <div class="card-body">
                            <div class="rotate">
                                <i class="fa fa-plus fa-7x"></i>
                            </div>
                           <a href="{{ route('produits.index') }}">
                            <h5 class="text-uppercase" style="color:rgb(255, 255, 255);">Produits Disponibles</h5>
                            <h3 class="display-4" style="font-size: 30px; color:rgb(255, 255, 255);"> {{$produit_total}}</h3>
                          </a> 
                        </div>
                    </div>
                    <div class="card text-white bg-info">
                        <div class="card-body" style="height: 100%; background-image: linear-gradient( to top,#808389, #6D7678);">
                            <div class="rotate">
                                <i class="fa fa-minus fa-7x"></i>
                            </div>
                           <a href="{{ route('produits.index') }}">
                             <h5 class="text-uppercase" style="color:rgb(255, 255, 255);">Vendus / Commandés</h5>
                             <h3 class="display-4" style="font-size: 30px; color:rgb(255, 255, 255);">{{$total}} / {{$produits_vendus}}</h3>
                          </a> 
                        </div>
                    </div>
                    <div class="card text-white bg-info">
                        <div class="card-body" style="height: 150%; background-image: linear-gradient( to top,#C94E15, #893914);">
                            <div class="rotate">
                                <i class="fa fa-cubes fa-7x"></i>
                            </div>
                           <a href="{{ route('produits.index') }}">
                             <h5 class="text-uppercase" style="color:rgb(255, 255, 255);">Revenue Totale</h5>
                            <h3 class="display-4" style="color:rgb(255, 255, 255); font-size:30px;">
                                {{number_format($prixR,0, ",", " " )}} <sup>FCFA</sup>
                            </h3>
                          </a> 
                        </div>
                    </div>
                </div>
                    <div class="col-xl-9 col-sm-6">
                        <div class="card">
                            <h5 class="card-header">Revenue</h5>
                            <div class="card-body"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                <canvas id="revenue" width="1003" height="376" style="display: block; width: 1003px; height: 376px;" class="chartjs-render-monitor"></canvas>
                            </div>
                            <div class="card-body border-top">
                                <div class="row">
                                
                                    <div class="offset-xl-1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 p-3">
                                        <h4 class="font-weight-normal mb-3"><span id="present">0 <sup>F</sup></span></h4>
                                        <div class="mb-0 mt-3 legend-item">
                                        <span class="fa-xs text-primary mr-1 legend-title "><i class="fa fa-fw fa-square-full"></i></span>
                                            <span class="legend-text">Cette Semaine</span></div>
                                    </div>
                                    <div class="offset-xl-1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 p-3">
                                        <h4 class="font-weight-normal mb-3"><span id="passer">0 <sup>F</sup></span></h4>
                                        <div class="text-muted mb-0 mt-3 legend-item"> <span class="fa-xs text-secondary mr-1 legend-title"><i class="fa fa-fw fa-square-full"></i></span><span class="legend-text">La Semaine passée</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div><br>


                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 row">  
                        <div class="col-xs-12 col-sm-12 col-md-12 "><br>    
                            <div class="card">
                                <i><center>Les Derniers Produits Commandés</center></i>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                            <thead  class="" style="background-color: #006680;">
                                                <tr>
                                                    <th style="color: white;" style="cursor: pointer;">N°</th>
                                                    <th style="color: white;" style="cursor: pointer;">Categorie</th>
                                                    <th style="color: white;" style="cursor: pointer;">Nom Produit</th>
                                                    <th style="color: white; text-align: center" style="cursor: pointer;">P U en FCFA</th>
                                                    <th style="color: white; text-align: center" style="cursor: pointer;">Quantité</th>
                                                    <th style="color: white; text-align: center" style="cursor: pointer;">Total en FCFA</th>
                                                    <th style="color: white; text-align: center" style="cursor: pointer;">Stock</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i=1;
                                            @endphp
                                                
                                    @foreach ($devi_produits as  $devi_produit)
                                        @foreach ($produits as $produit)
                                            @foreach ($commandes as $commande)
                                                @if($devi_produit->produit_id==$produit->id)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td style="cursor: pointer; text-transform: capitalize;">
                                                                                    @foreach ($produits as $produit)
                                                                                
                                                                                    @if($devi_produit->produit_id==$produit->id)
                                                                                        {{$produit->categorie}}
                                                                                        @endif
                                                                                    @endforeach                  
                                                        </td>
                                                        <td style="cursor: pointer; text-transform: capitalize;">
                                                                                @foreach ($produits as $produit)
                                                                                    @if($devi_produit->produit_id==$produit->id)
                                                                                        {{$produit->produit}}
                                                                                    @endif
                                                                                @endforeach
                                                        <td style="cursor: pointer; text-transform: capitalize; text-align: center">
                                                                            @foreach ($produits as $produit)
                                                                                @if($devi_produit->produit_id==$produit->id)
                                                                                {{$produit->prix1}}
                                                                                @endif
                                                                            @endforeach
                                                        </td>
                                                        <td style="cursor: pointer; text-align: center">{{$devi_produit->quantite}} </td>
                                                        <td style="cursor: pointer; text-transform: capitalize; text-align: center">
                                                            @foreach ($produits as $produit)
                                                                @if($devi_produit->produit_id==$produit->id)
                                                                {{$produit->prix1 * $devi_produit->quantite}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <!--<td style="cursor: pointer; text-transform: capitalize; text-align: center">
                                                            @foreach ($commandes as $commande)
                                                                @if($devi_produit->devi_id==$commande->devi_id)
                                                                {!! $commande->etat==1? "<span class='badge badge-info' >Commande en cours</span>":"<span class='badge badge-success'  >Commande validée</span>" !!}</td>
                                                                @endif
                                                            @endforeach
                                                        </td>-->
                                                    
                                                        <td style="cursor: pointer; text-align: center"> 
                                                                            @foreach ($produits as $produit)
                                                                                @if($devi_produit->produit_id==$produit->id)
                                                                                    @if($commande->etat==1)
                                                                                        @if ($produit->qte>=$devi_produit->quantite)
                                                                                        <span class="badge-dot badge-success mr-1"></span>Disponible</td>
                                                                                        @else
                                                                                        <span class="badge-dot badge-danger mr-1"></span>Indisponible</td>
                                                                                        @endif
                                                                                    @else
                                                                                        @if ($produit->qte>0)
                                                                                        <span class="badge-dot badge-success mr-1"></span>Disponible</td>
                                                                                        @else
                                                                                        <span class="badge-dot badge-danger mr-1"></span>Indisponible</td>
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                        </td>   

                                                @endif 
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                      
<!----------------------------------------------l'autre Tableau --------------------------------------------------------->
                        
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 row">  
                    <div class="col-xs-12 col-sm-12 col-md-12 "><br>   
                       @foreach ($devi_produits as  $devi_produit)
                         @foreach ($commandes as $commande)
                           @if($devi_produit->devi_id==$commande->devi_id && $commande->etat==2) 
                           
                        <div class="card">
                            <i><center>LES PRODUITS VENDUS AUJOURD'HUI</center></i>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                        <thead  class="" style="background-color: #028a2f;">
                                            <tr>
                                                <th style="color: white;" style="cursor: pointer;">N°</th>
                                                <th style="color: white;" style="cursor: pointer;">Categorie</th>
                                                <th style="color: white;" style="cursor: pointer;">Nom Produit</th>
                                                <th style="color: white; text-align: center" style="cursor: pointer;">P.U en FCFA</th>
                                                <th style="color: white; text-align: center" style="cursor: pointer;">Quantité Vendu</th>
                                                <th style="color: white; text-align: center" style="cursor: pointer;">Total en FCFA</th>
                                                <th style="color: white; text-align: center" style="cursor: pointer;">Disponibilité dans stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                            
                                @foreach ($devi_produits as  $devi_produit)
                                    @foreach ($produits as $produit)
                                        @foreach ($commandes as $commande)
                                            @if($devi_produit->produit_id==$produit->id)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td style="cursor: pointer; text-transform: capitalize;">
                                                                                @foreach ($produits as $produit)
                                                                            
                                                                                @if($devi_produit->produit_id==$produit->id)
                                                                                    {{$produit->categorie}}
                                                                                    @endif
                                                                                @endforeach                  
                                                    </td>
                                                    <td style="cursor: pointer; text-transform: capitalize;">
                                                                            @foreach ($produits as $produit)
                                                                                @if($devi_produit->produit_id==$produit->id)
                                                                                    {{$produit->produit}}
                                                                                @endif
                                                                            @endforeach
                                                    <td style="cursor: pointer; text-transform: capitalize; text-align: center">
                                                                        @foreach ($produits as $produit)
                                                                            @if($devi_produit->produit_id==$produit->id)
                                                                            {{$produit->prix1}}
                                                                            @endif
                                                                        @endforeach
                                                    </td>
                                                    <td style="cursor: pointer; text-align: center">{{$devi_produit->quantite}} </td>
                                                    <td style="cursor: pointer; text-transform: capitalize; text-align: center">
                                                        @foreach ($produits as $produit)
                                                            @if($devi_produit->produit_id==$produit->id)
                                                            {{$produit->prix1 * $devi_produit->quantite}}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <!--<td style="cursor: pointer; text-transform: capitalize; text-align: center">
                                                        @foreach ($commandes as $commande)
                                                            @if($devi_produit->devi_id==$commande->devi_id)
                                                            {!! $commande->etat==1? "<span class='badge badge-info' >Commande en cours</span>":"<span class='badge badge-success'  >Commande validée</span>" !!}</td>
                                                            @endif
                                                        @endforeach 
                                                    </td>-->
                                                
                                                    <td style="cursor: pointer; text-align: center"> 
                                                                        @foreach ($produits as $produit)
                                                                            @if($devi_produit->produit_id==$produit->id)
                                                                                @if($commande->etat==1)
                                                                                    @if ($produit->qte>=$devi_produit->quantite)
                                                                                    <span class="badge-dot badge-success mr-1"></span>Disponible</td>
                                                                                    @else
                                                                                    <span class="badge-dot badge-danger mr-1"></span>Indisponible</td>
                                                                                    @endif
                                                                                @else
                                                                                    @if ($produit->qte>0)
                                                                                    <span class="badge-dot badge-success mr-1"></span>Disponible</td>
                                                                                    @else
                                                                                    <span class="badge-dot badge-danger mr-1"></span>Indisponible</td>
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                    </td>   

                                            @endif 
                                        @endforeach
                                    @endforeach
                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                         @endif
                       @endforeach
                      @endforeach
                    </div>
                </div>
            </div>

                        

  <!----------------------------------------------------------------------------------------------------------------------->  

<!-- Modal  <a href="https://www.codeply.com/go/KrUO8QpyXP"  -->
    <script src="/assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>
    <script src="/assets/vendor/charts/charts-bundle/chartjs.js"></script>
    <script src="/assets/libs/js/dashboard-sales.js"></script>
<script>
    

    var date = new Date();
        var options = {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "2-digit"
        };
        var ladate = document.getElementById("ladate");

        ladate.innerText = date.toLocaleDateString("fr-FR", options);
</script>


<script>
$(document).ready(function() {
    
	$('[data-toggle=offcanvas]').click(function() {
	  $('.row-offcanvas').toggleClass('active');
	});
	
  });
</script>

@endsection