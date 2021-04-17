
 @include('animate_gestion_stock')
@extends('layout.index')
@php
$date = new DateTime('now', new DateTimeZone('UTC'));
use Carbon\Carbon;
$produit_total = \App\Models\Produit::whereYear('created_at', Carbon::now()->year)
    ->whereMonth('created_at', Carbon::now()->month)
    ->count();

//$produit_commander = Produit:: as 'prod' and Commande:: as 'com' where('prod->id','=','com->id')->whereYear('created_at', Carbon::now()->year)
 //                                                                              ->whereMonth('created_at', Carbon::now()->month)->paginate(10);
        			
$produit_en_stock = \App\Models\Produit::select('qte')
    ->where('qte', '>', 0)
    ->count();		

/*$mois_ci = Carbon::now()->format('F');
$jour_ci = Carbon::now()->day;  */ 			
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



<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left"> 
        <div class="col-md-3 col-lg-2 sidebar-offcanvas bg-light pl-0" id="sidebar" role="navigation">
            <ul class="nav flex-column sticky-top pl-0 pt-5 mt-3">
                <li class="nav-item"><a class="nav-link" href="#">Stock Produit</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Produits▾</a>
                    <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
                       <li class="nav-item"><a class="nav-link" href="">Ajouter Produit</a></li>
                       <li class="nav-item"><a class="nav-link" href="">Lister Produit</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Clients</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Voitures</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Commandes</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Diagnostics</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Devis</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Interventions</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Factures</a></li>
            </ul>
        </div>
        <!--/col--> 
        

        <div class="col main pt-5 mt-3">
            <h1 class="display-4 d-none d-sm-block">
            GESTION DE STOCK
            </h1>   
            <p class="lead d-none d-sm-block">Garage Saka</p>

       <!--     <div class="row mb-3">
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body bg-success">
                            <div class="rotate">
                                <i class="fa fa-user fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Client</h6>
                            <h1 class="display-4">134</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <i class="fa fa-list fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Posts</h6>
                            <h1 class="display-4">87</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <i class="fa fa-twitter fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Tweets</h6>
                            <h1 class="display-4">125</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-body">
                            <div class="rotate">
                                <i class="fa fa-share fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Shares</h6>
                            <h1 class="display-4">36</h1>
                        </div>
                    </div>
                </div>
            </div>   -->

			<div class="row mb-3">
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body bg-success">
                            <div class="rotate">
                                <i class="fa fa-cubes fa-5x"></i>
                            </div>
                          <a href="{{ route('produits.index') }}">
                            <h6 class="text-uppercase" style="color:rgb(255, 255, 255);">Total Produits</h6>
                            <h1 class="display-4" style="color:rgb(255, 255, 255);">{{$produit_total}}</h1>
                         </a> 
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <i class="fa fa-plus fa-5x"></i>
                            </div>
                           <a href="{{ route('produits.index') }}">
                            <h6 class="text-uppercase" style="color:rgb(255, 255, 255);">Total Produits Commandés/Vendus</h6>
                            <h1 class="display-4" style="color:rgb(255, 255, 255);">0</h1>
                          </a> 
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <i class="fa fa-minus fa-5x"></i>
                            </div>
                           <a href="{{ route('produits.index') }}">
                             <h6 class="text-uppercase" style="color:rgb(255, 255, 255);">Total Produits Restants</h6>
                             <h1 class="display-4" style="color:rgb(255, 255, 255);">{{$produit_en_stock}}</h1>
                          </a> 
                        </div>
                    </div>
                </div>
              <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-body">
                            <div class="rotate">
                                <i class="fa fa-share fa-5x"></i>
                            </div>
                            <a href="{{ route('produits.index') }}">
                            <h6 class="text-uppercase" style="color:rgb(255, 255, 255);">Total Revenue</h6>
                            <h1 class="display-4" style="color:rgb(255, 255, 255);">?</h1>
                        </a> 
                        </div>
                    </div>
                </div>
            </div>
           
            <!--/row-->
            <hr>        
            <div class="row placeholders mb-3">
                <div class="col-6 col-sm-3 placeholder text-center">
                    <img class="mx-auto img-fluid rounded-circle" src="https://previews.123rf.com/images/macrovector/macrovector1412/macrovector141200021/34231705-service-de-pneu-m%C3%A9canicien-automobile-de-r%C3%A9paration-automobile-ic%C3%B4nes-ensemble-isol%C3%A9-plat-illustration-vector.jpg" alt="imageproduit">
                    <h4>Produit</h4>
                    <span class="text-muted">  </span>
                </div>
                <div class="col-6 col-sm-3 placeholder text-center">
                    <img  class="mx-auto img-fluid rounded-circle" src="https://images-eu.ssl-images-amazon.com/images/I/617sJm3o4TL.png"
                            alt="jenseign">
                    <h4>Diagnostic</h4>
                    <span class="text-muted">  </span>
                </div>
                <div class="col-6 col-sm-3 placeholder text-center">
                    <img class="mx-auto img-fluid rounded-circle" src="https://cdn.www.zervant.com/wp-content/uploads/2016/01/modele-gratuit-devis_feature-image.png" alt="Generic placeholder thumbnail">
                    <h4>Devis</h4>
                    <span class="text-muted">  </span>
                </div>
                <div class="col-6 col-sm-3 placeholder text-center">
                    <img class="center-block img-fluid rounded-circle" src="https://previews.123rf.com/images/macrovector/macrovector1505/macrovector150500030/40283822-m%C3%A9canicien-automobile-r%C3%A9paration-voiture-de-service-et-de-travaux-d-entretien-icons-set-isol%C3%A9-illustrat.jpg" 
                                 alt="Generic placeholder thumbnail">
                    <h4>Intervention</h4>
                    <span class="text-muted">  </span>
                </div>
            </div>

            <a id="features"></a>
            <hr>
            <p class="lead mt-5">
                Les Produits Commandés aujourd'hui!!
            </p>
            <div class="row my-4">
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="//placehold.it/740x180/bbb/fff?text=..." alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">Produits</h4>
                            <p class="card-text">Les produits ajoutés / Liste des produits  !!!!</p>
                            <a href="{{route('produits.index')}}" class="btn btn-primary">Afficher</a>
                        </div>
                    </div>
                    <div class="card card-inverse bg-inverse mt-3">
                        <div class="card-body">     
                            <h3 class="card-title">Produits Approvisionnés</h3>
                            <p class="card-text">Les produits vendus / Liste des produits  !!!! </p>
                     <center>  <a href="{{route('approvisionnements.index')}}" class="btn btn-outline-secondary">Voir</a> </center> 
                        </div>
                    </div>
                </div>
                  
                <div class="col-lg-9 col-md-8">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-inverse">
                                <tr>
                                    <th style="cursor: pointer;">N°</th>
                                    <th style="cursor: pointer;">Catégorie</th>
                                    <th style="cursor: pointer;">Nom Produit</th>
                                    <th style="cursor: pointer;">Prix Unitaire</th>
                                    <th style="cursor: pointer;">En Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr>
                                    <td><div id="ladate"></td>
                                    <td style="cursor: pointer; text-transform: capitalize;">Mediapex</td>
                                    <td style="cursor: pointer; text-transform: capitalize;">Medoune</td>
                                    <td style="cursor: pointer;">12000<sup>F CFA</sup> </td>
                                    <td style="cursor: pointer;">?</td>   
                                    </tbody>
                                    </tr>
                                  </table>
                        </div>
                     </div>
                  </div>
            <!--/row-->

     <!--------------------------------------------------->
            

<!-- Modal  <a href="https://www.codeply.com/go/KrUO8QpyXP"  -->


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