@extends('layout.index')
@php
setlocale(LC_TIME, 'fr_FR', 'French');
$date = new DateTime('now', new DateTimeZone('UTC'));
use Carbon\Carbon;
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

@endphp
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"
        integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="/assets/libs/css/clock.css">
    <style>
        #cercle .card {

            justify-content: center;
            align-self: center;
            align-items: center;
            align-content: center;
            height: 200px;


        }

        .time {
            align-self: center;
            margin-top: 30% !important;
        }

        .clw {
            color: white !important;
        }

        #block-1 .card {
            background-image: linear-gradient(to top, #1f575a, #068c94);
            color: white !important;
            box-shadow: 2px 5px 5px 1px #d3d0d0;
            height: 200px;
        }

        #block-2 .card {
            background-image: linear-gradient(to top, #a85e7b, #df5a8f);
            color: white !important;
            box-shadow: 2px 5px 5px 1px #d3d0d0;
            height: 200px;
        }

        #block-3 .card {
            background-image: linear-gradient(to top, #3a6297, #3977c8);
            color: white !important;
            box-shadow: 2px 5px 5px 1px #d3d0d0;
            height: 200px;
        }

        .history {
            background-color: #1891ea;
            justify-content: center;
            text-align: center;
            border-radius: 15px;
            width: auto;
            height: 45px;


        }

        .history h4 {
            color: white;
            text-align: center;
            padding: 10px;
        }

        .card-header {
            background-color: #2f7272;
            color: white;
        }

        .titre_statistique{
            width: 100%; 
            text-align: center; 
            /* border-bottom: 1px solid #000;  */
            line-height: 0.1em;
            margin: 10px 0 20px; 
        }
        .titre_statistique span { 
            background-image: linear-gradient(to left, #000, grey);
            color:#fff;
            border-radius:20px;
            padding:0 10px;
            padding:5px;
            padding-left: 20px;
            padding-right: 20px;
        }
         .box_section{
            border: 1px solid grey; 
            border-radius:10px;
             margin-bottom:20px; 
             box-shadow: 0px 3px 0px grey;
         }
        .float-left span {
            box-shadow: 2px 2px 0px gray;
            background: #fff;
            color:gray;
            
        }
    </style>


    <!-- ---------------------------Horloge, nb client, nb voiture nb intervention -------------------------------------- -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row" style="border: 1px solid grey; border-radius:10px; margin-bottom:20px; box-shadow: 3px 0px 3px grey;">
            <div class="float-left"><span class="badge badge-pill badge-info">1 <sup>ere </sup>Section</span></div><br>
            <h4 class="titre_statistique"><span>Statistiques du mois en cours</span> </h4>
            <!-- Horloge  -->
            <div class="col-xl-3 col-md-6  col-lg-4 col-sm-12 " id="cercle">
                <div class="card">
                    <div class="card-body">
                        <div id="clock"></div>
                        <h5 class="text-center" style="text-transform: capitalize;" id="ladate"></h5>
                    </div>
                </div>
            </div>
            <!-- FIN Horloge -->

            <!--nb client-->
            <div class="col-xl-3 col-md-6 col-lg-4 col-sm-12 col-12" id="block-1" style="text-align: center; cursor: pointer;">
                <div class="card" onclick="show('clients-mois')">
                    <div class="card-body "><br>
                        <div class="metric-value d-inline-block">
                            <p>
                                <span class="clw compteur"
                                    style="font-weight: bold; font-size:30px;">{{ $clients }}</span>
                                <span class="clw"
                                    style="font-weight: bold;margin-left: 10px;font-size:20px;">{{ $clients > 1 ? 'Clients' : 'Client' }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 text-center pt-6">
                        <img style="height: 50px;width: auto;" class="" src="/assets/images/user1.png" alt="logo">
                    </div><br>
                </div>
            </div>
        <!-- FIN nb client -->

        <!-- nd voiture -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="block-2" style="text-align: center; cursor: pointer;">
                <div class="card" onclick="show('voitures-mois')">
                    <div class="card-body "><br>
                        <div class="metric-value d-inline-block">
                            <p>
                                <span class="clw compteur1"
                                    style="font-weight: bold; font-size:30px;">{{ $voitures}}</span>
                                <span class="clw"
                                    style="font-weight: bold;margin-left: 10px;font-size:20px;">{{ $voitures > 1 ? 'Voitures' : 'Voiture' }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 text-center pt-6">
                        <img style="height: 50px;width: auto;" class="" src="/assets/images/car12.png" alt="logo">
                    </div><br>
                </div>
            </div>
        <!-- Fin nb voiture  -->

        <!-- nb intervention  -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="block-3" style="text-align: center; cursor: pointer;">
                <div class="card" onclick="show('interventions-mois')">
                    <div class="card-body "><br>
                        <div class="metric-value d-inline-block">
                            <p>
                                <span class="clw compteur2"
                                    style="font-weight: bold; font-size:30px;">{{ $interventions }}
                                </span>
                                <span class="clw"
                                    style="font-weight: bold;margin-left: 10px;font-size:20px;">{{ $interventions > 1 ? 'Interventions' : 'Intervention' }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 text-center pt-6">
                        <img style="height: 50px;width: auto;" class="" src="/assets/images/out1.png" alt="logo">
                    </div><br>
                </div>
            </div>
        <!-- FIN nb intervention  -->
        </div>
          
    </div>
    <!-- -------------------------------FIN Horloge, nb client, nd voiture nb intervention------------------------  -->


    <!-- -----------------------------------------les vente Facture ..... -------------------------------------------->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row box_section" style="margin-top:20px">
            <div class="float-left"><span class="badge badge-pill badge-info">2<sup>e </sup> Section</span></div><br>
            <h4 class="titre_statistique"><span>Flux des Ventes</span> </h4>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 ">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Les Ventes d'Aujourd'hui</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{ $produit_en_stock }}</h1>
                        </div>
                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                            <span class="icon-circle-small icon-box-xs text-success bg-success-light">
                                <i class="fa fa-fw fa-arrow-up"></i>
                            </span>
                            <span class="ml-1">5%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Les Ventes de ce Mois-ci</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{ $produit_en_stock }}</h1>
                        </div>
                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i
                                    class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Les Factures d’Aujourd’hui</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{ $facturesJour }}</h1>
                        </div>
                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i
                                    class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Les Factures de ce Mois</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{ $facturesMois }}</h1>
                        </div>
                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                            <span class="icon-circle-small icon-box-xs text-success bg-success-light">
                                <i class="fa fa-fw fa-arrow-up"></i>
                            </span>
                            <span class="ml-1">5%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Prix total des produits en stock</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{ number_format($prix_total_des_produits, 0, ',', ' ') }}<sup>F CFA</sup>
                            </h1>
                        </div>
                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                            <span class="icon-circle-small icon-box-xs text-success bg-success-light">
                                <i class="fa fa-fw fa-arrow-up"></i>
                            </span>
                            <span class="ml-1">10%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ----------------------------------------FIN les vente Facture ---------------------------------------- -->


    <!-- ------------------------------------tableau recaputulatif  jour et mois --------------------------------->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row box_section">
            <div class="float-left"><span class="badge badge-pill badge-info">3<sup>e </sup> Section</span></div><br>
            <h4 class="titre_statistique"><span>Recap Journalier | Mensuel</span> </h4>
        <!-- tableau recaputulatif du jour -->
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Tableau récaptulatif du Jour</h5>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Jour</th>
                                    <th scope="col">Nombre Interventions</th>
                                    <th scope="col">Facture Impayée</th>
                                    <th scope="col">Chiffre d'Affaire</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Lundi 29 Mars 2021</td>
                                    <td>17</td>
                                    <td>450000</td>
                                    <td>230000</td>
                                </tr>
                                <tr>
                                    <td>Lundi 29 Mars 2021</td>
                                    <td>17</td>
                                    <td>450000</td>
                                    <td>230000</td>
                                </tr>
                                <tr>
                                    <td>Lundi 29 Mars 2021</td>
                                    <td>17</td>
                                    <td>450000</td>
                                    <td>230000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <!-- FIN tableau recaputulatif du jour -->

        <!-- tableau recaputulatif du mois -->
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Tableau récaptulatif du Mois</h5>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Mois</th>
                                    <th scope="col">Nombre Interventions</th>
                                    <th scope="col">Facture Impayée</th>
                                    <th scope="col">Chiffre d'Affaire</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mars 2021</td>
                                    <td>17</td>
                                    <td>450000</td>
                                    <td>230000</td>
                                </tr>
                                <tr>
                                    <td>Mars 2021</td>
                                    <td>17</td>
                                    <td>450000</td>
                                    <td>230000</td>
                                </tr>
                                <tr>
                                    <td>Mars 2021</td>
                                    <td>17</td>
                                    <td>450000</td>
                                    <td>230000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <!-- FIN tableau recaputulatif du mois -->
        </div>
    </div>
    <!----------------------------------- FIN tableau recaputulatif du jour et moi------------------------s-->


    <!-- ---------------------------------------------Chiffre affaire / mois --------------------------->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row box_section">
            <div class="float-left"><span class="badge badge-pill badge-info">4<sup>e </sup> Section</span></div><br>
            <h4 class="titre_statistique"><span>Chiffre d'affaire Mensuel</span> </h4>
              <!--  Chiffre affaire de ce mois -->
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Chiffre affaire de ce mois</h5>
                    <div class="card-body">
                        <div id="morris_gross" style="height: 272px;"></div>
                    </div>
                    <div class="card-footer bg-white">
                        <p>
                            Payé<span class="float-right text-dark" id="paye"></span>
                        </p>
                        <p>
                            Impayé<span class="float-right text-dark" id="impaye"></span>
                        </p>
                    </div>
                </div>
            </div>
            <!--  FIN Chiffre affaire de ce mois -->

            <!--  Chiffre affaire par mois -->
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Chiffre affaire par mois</h5>
                    <div class="card-body">
                        <canvas id="chartjs_balance_bar"></canvas>
                    </div>
                </div>
            </div>
            <!--  FIN Chiffre affaire par mois -->

        </div>
    </div>
    <!-- ----------------------------------------- FIN Chiffre affaire / mois ------------------------------------->


    
    <!-- ------------------------------------tableau recaputulatif  jour et mois --------------------------------->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row box_section">
            <div class="float-left"><span class="badge badge-pill badge-info">5<sup>e </sup> Section</span></div><br>
            <h4 class="titre_statistique"><span>Garage</span> </h4>
        <!-- tableau chiffre d'affaire de ce mois -->
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">chiffre d'affaire de ce mois</h5>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th  scope="col">CA</th>
                                    <td>17 000 000</td>
                                </tr>
                                <tr>
                                    <th  scope="col">Impayé</th>
                                    <td>1 200 000</td>
                                </tr>
                                <tr>
                                    <th>TOTAL</th>
                                    <th>18 200 000</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <!-- FIN tableau chiffre d'affaire de ce mois -->

        <!-- LISTE voiture en garage -->
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Voitures en garage</h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0">Matricule</th>
                                        <th class="border-0">Marque</th>
                                        <th class="border-0">Model</th>
                                        <th class="border-0">Propriétaire</th>
                                        <th class="border-0">état</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>DK1010AA</td>
                                        <td>BMW</td>
                                        <td>Alpha</td>
                                        <td>Moussa thiam</td>
                                        <td>réparé</td>
                                    </tr>
                                    <tr>
                                        <td>DK1010AA</td>
                                        <td>BMW</td>
                                        <td>Alpha</td>
                                        <td>Moussa thiam</td>
                                        <td>réparé</td>
                                    </tr>
                                    <tr>
                                        <td>DK1010AA</td>
                                        <td>BMW</td>
                                        <td>Alpha</td>
                                        <td>Moussa thiam</td>
                                        <td>réparé</td>
                                    </tr>
                                    <tr>
                                        <td>DK1010AA</td>
                                        <td>BMW</td>
                                        <td>Alpha</td>
                                        <td>Moussa thiam</td>
                                        <td>réparé</td>
                                    </tr>
                                    <tr>
                                        <td colspan="9"><a href="#" class="btn btn-outline-light float-right">View Details</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN LISTE voiture en garage -->

        </div>
    </div>
    <!----------------------------------- FIN tableau recaputulatif du jour et moi------------------------s-->




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
       crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
        integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
        crossorigin="anonymous"></script>
    <script src="assets/libs/js/clock.js"></script>
   
     <!-- morris js -->
     <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
     <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
     <script src="assets/vendor/charts/morris-bundle/morrisjs.html"></script>
    <script src="/assets/libs/js/les_courbes.js"></script>

   


    <script>
       
        // FIN Chiffre affaire par mois





        var date = new Date();
        var options = {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "2-digit"
        };
        var ladate = document.getElementById("ladate");

        ladate.innerText = date.toLocaleDateString("fr-FR", options);


        $({
            Counter: 0
        }).animate({
            Counter: $('.compteur').text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function() {
                $('.compteur').text(Math.ceil(this.Counter));
            }
        });

        $({
            Counter: 0
        }).animate({
            Counter: $('.compteur1').text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function() {
                $('.compteur1').text(Math.ceil(this.Counter));
            }
        });
        $({
            Counter: 0
        }).animate({
            Counter: $('.compteur2').text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function() {
                $('.compteur2').text(Math.ceil(this.Counter));
            }


        });
        $({
            Counter: 0
        }).animate({
            Counter: $('.compteurqte').text()
        }, {
            duration: 2000,
            easing: 'swing',
            step: function() {
                $('.compteurqte').text(Math.ceil(this.Counter));
            }


        });

       
    </script>
     <script>
        function show(page) {
            window.location = page;
        }

    </script>
@endsection
