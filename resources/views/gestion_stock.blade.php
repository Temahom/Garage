
 @include('animate_gestion_stock')
@extends('layout.index')

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
                            <h6 class="text-uppercase">Total Produits</h6>
                            <h1 class="display-4">134</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <i class="fa fa-plus fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase">Total Produits Commandés/Vendus</h6>
                            <h1 class="display-4">87</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <i class="fa fa-minus fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase">Total Produits Restants</h6>
                            <h1 class="display-4">125</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-body">
                            <div class="rotate">
                                <i class="fa fa-share fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase">Total Revenue</h6>
                            <h1 class="display-4">36</h1>
                        </div>
                    </div>
                </div>
            </div>
           
            <!--/row-->

            <hr>
            <div class="row placeholders mb-3">
                <div class="col-6 col-sm-3 placeholder text-center">
                    <img src="//placehold.it/200/dddddd/fff?text=1" class="mx-auto img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                    <h4>Produit</h4>
                    <span class="text-muted">  </span>
                </div>
                <div class="col-6 col-sm-3 placeholder text-center">
                    <img src="//placehold.it/200/e4e4e4/fff?text=2" class="mx-auto img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                    <h4>Diagnostic</h4>
                    <span class="text-muted">  </span>
                </div>
                <div class="col-6 col-sm-3 placeholder text-center">
                    <img src="//placehold.it/200/d6d6d6/fff?text=3" class="mx-auto img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                    <h4>Devis</h4>
                    <span class="text-muted">  </span>
                </div>
                <div class="col-6 col-sm-3 placeholder text-center">
                    <img src="//placehold.it/200/e0e0e0/fff?text=4" class="center-block img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                    <h4>Intervention</h4>
                    <span class="text-muted">  </span>
                </div>
            </div>

            <a id="features"></a>
            <hr>
            <p class="lead mt-5">
                Liste Produits dans Devis.
            </p>
            <div class="row my-4">
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="//placehold.it/740x180/bbb/fff?text=..." alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">Produits</h4>
                            <p class="card-text">Les produits ajoutées / Liste des produits  !!!!</p>
                            <a href="#" class="btn btn-primary">Button</a>
                        </div>
                    </div>
                    <div class="card card-inverse bg-inverse mt-3">
                        <div class="card-body">
                            <h3 class="card-title">Produits</h3>
                            <p class="card-text">Les produits vendus / Liste des produits  !!!! </p>
                            <a href="#" class="btn btn-outline-secondary">Outline</a>
                        </div>
                    </div>
                </div>
                  
                <div class="col-lg-9 col-md-8">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire (F CFA)</th>
                                    <th>Montant (F CFA)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1,001</td>
                                    <td>Moussa</td>
                                    <td>web designers</td>
                                    <td>cards</td>
                                    <td>grid</td>
                                </tr>
                                <tr>
                                    <td>1,002</td>
                                    <td>Medoune</td>
                                    <td>web designers</td>
                                    <td>theme</td>
                                    <td>responsive</td>
                                </tr>
                                <tr>
                                    <td>1,003</td>
                                    <td>abdou Aziz</td>
                                    <td>developer</td>
                                    <td>download</td>
                                    <td>template</td>
                                </tr>
                                <tr>
                                    <td>1,003</td>
                                    <td>Hilde</td>
                                    <td>developer</td>
                                    <td>coding</td>
                                    <td>card panel</td>
                                </tr>
                                <tr>
                                    <td>1,004</td>
                                    <td>Mohamet</td>
                                    <td>web designers 4</td>
                                    <td>mobile-first</td>
                                    <td>design</td>
                                </tr>
                                <tr>
                                    <td>1,005</td>
                                    <td>Moustapha</td>
                                    <td>developer</td>
                                    <td>jumbtron</td>
                                    <td>header</td>
                                </tr>
                                <tr>
                                    <td>1,006</td>
                                    <td>Yacine</td>
                                    <td>developer</td>
                                    <td>submenu</td>
                                    <td>flexbox</td>
                                </tr>
                                <tr>
                                    <td>1,007</td>
                                    <td>Fatou</td>
                                    <td>developer</td>
                                    <td>themes</td>
                                    <td>grid</td>
                                </tr>
                                <tr>
                                    <td>1,008</td>
                                    <td>Dieynaba</td>
                                    <td>developer 4</td>
                                    <td>flexbox</td>
                                    <td>design</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/row-->
            

<!-- Modal  <a href="https://www.codeply.com/go/KrUO8QpyXP"  -->


<script>
$(document).ready(function() {
    
	$('[data-toggle=offcanvas]').click(function() {
	  $('.row-offcanvas').toggleClass('active');
	});
	
  });
</script>

@endsection