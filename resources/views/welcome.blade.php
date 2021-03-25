@extends('layout.index')
@php
setlocale(LC_TIME, "fr_FR", "French");
$date = new DateTime('now', new DateTimeZone('UTC'));
use Carbon\Carbon;
  $clients=\App\Models\Client::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
  $chiffres=\App\Models\Devi::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('cout');
  $produit_en_stock=\App\Models\Produit::select("qte")->where('qte','>',0)->count();
  $produit_total=\App\Models\Produit::sum("qte");
  $prix_total_des_produits=\App\Models\Produit::sum("prix1");
  $client30=\App\Models\Client::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-1)->count();
  $chiffre30=\App\Models\Devi::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-1)->sum('cout');
 
  $client60=\App\Models\Client::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-2)->count();
  $chiffre60=\App\Models\Devi::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-2)->sum('cout');
 $total=$chiffres+$chiffre30+$chiffre60;
 //*************Ventes et Factures
  $facturesMois=\App\Models\Facture::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
     //facture aujourd"hui
  $facturesJour=\App\Models\Facture::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->count();
       ///Tab Recapitulatif Mensuel de diagnostic,Devis et Interventions
   $diagnostics=\App\Models\Diagnostic::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
   $devis=\App\Models\Devi::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
   $interventions=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
    $mois_ci=Carbon::now()->format('F');
   $voitures=\App\Models\Voiture::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
   
  


@endphp
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
<link rel="stylesheet" href="/assets/libs/css/clock.css">
<style>

    .row{
        overflow: hidden;
    }
    #cercle .card {
      
        justify-content: center;
        align-self: center;
        align-items: center;
        align-content: center;
        height: 200px;
     
      
    }
    .time{
        align-self: center;
        margin-top:30% !important;
    }
    .clw{
        color: white !important;
    }
    #block-1 .card{
        background-image: linear-gradient( to top,#1f575a, #068c94);
        color: white !important;
        box-shadow: 2px 5px 5px 1px #d3d0d0;
        height: 200px;
    }
    #block-2 .card{
        background-image: linear-gradient( to top,#a85e7b, #df5a8f);
        color: white !important;
        box-shadow: 2px 5px 5px 1px #d3d0d0;
        height: 200px;
    }

    #block-3 .card{
        background-image: linear-gradient( to top,#3a6297, #3977c8);
        color: white !important;
        box-shadow: 2px 5px 5px 1px #d3d0d0;
        height: 200px;
    }
     .history{
        background-color: #1891ea;
        justify-content: center;
        text-align: center;
        border-radius: 15px;
        width: auto;
        height:45px;

       
    }
    .history h4{
        color: white;
        text-align: center;
        padding: 10px;
    }

    .card-header{
        background-color: #2f7272;
        color: white;
    }
    
    .chart{
        width: 500px;
        height: 500px;
    }
</style>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 row">  
    
        <div class="col-xl-3 col-md-6  col-lg-4 col-sm-12 " id="cercle">
            <div class="card">
                <div class="card-body">
                        <div id="clock"></div>
                            <h5 class="text-center" style="text-transform: capitalize;" id="ladate"></h5>
                </div>           
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-lg-4 col-sm-12 col-12" id="block-1" style="text-align: center; cursor: pointer;">
            <div class="card" onclick="show('clients')">
                <div class="card-body " ><br>
                    <div class="metric-value d-inline-block">
                        <p>
                            <span class="clw compteur"  style="font-weight: bold; font-size:30px;">{{\App\Models\Client::count()}}</span>
                            <span class="clw" style="font-weight: bold;margin-left: 10px;font-size:20px;">{{\App\Models\Client::count()>1?"Clients":"Client"}}</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 text-center pt-6">
                    <img style="height: 50px;width: auto;" class="" src="/assets/images/user1.png" alt="logo">
                </div><br>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="block-2" style="text-align: center; cursor: pointer;">
            <div class="card" onclick="show('voitures')">
                <div class="card-body " ><br>
                    <div class="metric-value d-inline-block" >
                        <p>
                            <span class="clw compteur1" style="font-weight: bold; font-size:30px;" >{{\App\Models\Voiture::count()}}</span>
                            <span class="clw" style="font-weight: bold;margin-left: 10px;font-size:20px;">{{\App\Models\Voiture::count()>1?"Voitures":"Voiture"}}</span>
                        </p>
                    </div>    
                </div>
                <div class="col-md-12 col-sm-12 text-center pt-6">
                    <img style="height: 50px;width: auto;" class="" src="/assets/images/car12.png" alt="logo">
                </div><br>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="block-3" style="text-align: center; cursor: pointer;">
            <div class="card" onclick="show('interventions-list')">
                <div class="card-body " ><br>
                    <div class="metric-value d-inline-block">
                        <p>
                            <span class="clw compteur2" style="font-weight: bold; font-size:30px;">{{\App\Models\Intervention::count()}}</span>
                            <span class="clw" style="font-weight: bold;margin-left: 10px;font-size:20px;">{{\App\Models\Intervention::count()>1?"Interventions":"Intervention"}}</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 text-center pt-6">
                    <img style="height: 50px;width: auto;" class="" src="/assets/images/out1.png" alt="logo">
                </div><br>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  

              <!-- ============================================================== -->
                    <!-- visitor  -->
                    <!-- ============================================================== -->
                <!--  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="card border-3 border-top border-top-primary">
                            <div class="card-body">
                                <h5 class="text-muted">Nombre de produit en Stock</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1">{{ $produit_en_stock}}</h1>
                                </div>
                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                    <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                                </div>
                            </div>
                        </div>
                    </div>    -->
                    <!-- ============================================================== -->
                    <!-- end visitor  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- sales  -->
                    <!-- ============================================================== -->
                <!--    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="card border-3 border-top border-top-primary">
                            <div class="card-body">
                                <h5 class="text-muted">Quantité de produits en stock</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1 compteurqte">{{$produit_total}}</h1>
                                </div>
                                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                    <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5.86%</span>
                                </div>
                            </div>
                        </div>
                    </div>     -->
                    <!-- ============================================================== -->
                    <!-- end sales  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- new customer  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Les Ventes d'Aujourd'hui</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{ $produit_en_stock}}</h1>
                    </div>
                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end visitor  -->
         <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Les Ventes de ce Mois-ci</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{ $produit_en_stock}}</h1>
                    </div>
                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end visitor  -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Les Factures d’Aujourd’hui</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{$facturesJour}}</h1>
                    </div>
                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end visitor  -->
          <!-- end visitor  -->
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Les Factures de ce Mois</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{ $facturesMois}}</h1>
                    </div>
                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end visitor  -->
                <!-- ============================================================== -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Prix total des produits en stock</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{number_format($prix_total_des_produits,0, ",", " " )}}<sup>F CFA</sup></h1>
                        </div>
                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">10%</span>
                        </div>
                    </div>
                </div>
            </div>
                        <!-- ============================================================== -->
                        <!-- end new customer  -->
                <!-- ============================================================== -->
                <!-- total orders  -->
                <!-- ============================================================== -->
            <!--    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card border-3 border-top border-top-primary">
                        <div class="card-body">
                            <h5 class="text-muted">Produits Restants</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">1340</h1>
                            </div>
                            <div class="metric-label d-inline-block float-right text-danger font-weight-bold">
                                <span class="icon-circle-small icon-box-xs text-danger bg-danger-light bg-danger-light "><i class="fa fa-fw fa-arrow-down"></i></span><span class="ml-1">4%</span>
                            </div>
                        </div>
                    </div>
                </div>   -->
    </div>
</div>  


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
        <div class="col-xl-6 col-lg-6 col-md-10 col-sm-12 col-12 mt-5">
            <div class="card">
                <h5 class="card-header" style="text-align: center;  background-color: #068c94;">Tableau récaptulatif mensuel des Clients</h5>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">Vieillissement du client</th>
                                    <th class="border-0">Clients</th>
                                    <th class="border-0">Chiffre d'affaire</th>
                                    <th class="border-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Il y'a 0 à 30 jours</td>
                                    <td>{{$clients}} {{$clients>1?"clients":"client"}} </td>
                                    <td>{{number_format($chiffres,0, ",", " " )}} <sup>F CFA</sup></td>
                                    <td><span class="badge-dot badge-success mr-1"></span>Validé </td>
                                </tr>
                                <tr>
                                    <td>Il y'a 31 à 60 jours</td>
                                    <td>{{$client30}} {{$client30>1?"clients":"client"}} </td>
                                    <td>{{number_format($chiffre30,0, ",", " " )}} <sup>F CFA</sup></td>
                                    <td><span class="badge-dot badge-success mr-1"></span>Validé </td>
                                </tr>
                                <tr>
                                    <td>Il y'a 61 à 90 jours</td>
                                    <td>{{$client60}}  {{$client60>1?"clients":"client"}} </td>
                                    <td>{{number_format($chiffre60,0, ",", " " )}} <sup>F CFA</sup></td>
                                    <td><span class="badge-dot badge-success mr-1"></span>Validé </td>
                                </tr>
                                
                                <tr>
                                    <td style="font-size: 15px; font-weight: bold;" colspan="9"><span class="float-right"><strong>Totale : {{number_format($total,0, ",", " " )}}<sup> F CFA</sup></strong></span></td>
                                </tr>
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-10 col-sm-12 col-12 mt-5">
            <div class="card">
                <h5 class="card-header" style="text-align: center ; background-color: #068c94;">Tableau récaptulatif de ce mois_ci </h5>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">Ce Mois-ci</th>
                                    <th class="border-0">Diagnostics</th>
                                    <th class="border-0">Devis</th>
                                    <th class="border-0">Interventions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$mois_ci}}</td>
                                    <td>{{$diagnostics}} {{$diagnostics>1?"diagnostics":"diagnostic"}} </td> 
                                    <td>{{$devis}} {{$devis>1?"devis":"devi"}} </td>
                                    <td>{{$interventions}} {{$interventions>1?"interventions":"intervention"}} </td>
                                    </tr>
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
        </div>

   </div>
</div>
 {{-- fin tableau de Vieillissment du clients --}}
<div class="row">
    <div class="col-md-6 chart">
        <canvas id="myChart" ></canvas>
    </div>
    <div class="col-md-6 chart">
        <canvas id="myChart2" ></canvas>
    </div>
</div>
 {{-- debut tableau recaputulatif de ce mois_ci--}}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
        <div class="col-xl-6 col-lg-6 col-md-10 col-sm-12 col-12 mt-5">
            <div class="card">
                <h5 class="card-header" style="text-align: center ; background-color: #068c94;">Tableau récaptulatif de ce mois_ci </h5>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">Ce Mois-ci</th>
                                    <th class="border-0">Diagnostics</th>
                                    <th class="border-0">Devis</th>
                                    <th class="border-0">Interventions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$mois_ci}}</td>
                                    <td>{{$diagnostics}} {{$diagnostics>1?"diagnostics":"diagnostic"}} </td> 
                                    <td>{{$devis}} {{$devis>1?"devis":"devi"}} </td>
                                    <td>{{$interventions}} {{$interventions>1?"interventions":"intervention"}} </td>
                                    </tr>
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
        </div>

</div>
</div> 
 {{-- fin tableau recaputulatif de ce mois ci--}}   

 {{-- debut tableau recaputulatif de ce mois_ci avec clients et voitures--}}
 <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 mt-8">
            <div class="card">
                <h5 class="card-header" style="text-align: center ; background-color: #339207;">Tableau récaptulatif du Mois </h5>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">Ce Mois-ci</th>
                                    <th class="border-0">Clients</th>  
                                    <th class="border-0">Voitures</th>
                                    <th class="border-0">Diagnostics</th>
                                    <th class="border-0">Devis</th>
                                    <th class="border-0">Interventions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$mois_ci}}</td>
                                    <td>{{$clients}} {{$clients>1?"clients":"client"}} </td> 
                                    <td>{{$voitures}} {{$voitures>1?"voitures":"voiture"}} </td> 
                                    <td>{{$diagnostics}} {{$diagnostics>1?"diagnostics":"diagnostic"}} </td> 
                                    <td>{{$devis}} {{$devis>1?"devis":"devi"}} </td>
                                    <td>{{$interventions}} {{$interventions>1?"interventions":"intervention"}} </td>
                                    </tr>
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
        </div>

</div>
</div> 
 {{-- fin tableau recaputulatif de ce mois ci avec clients et voitures--}}   



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<script src="assets/libs/js/clock.js"></script>
<script>
    function show(page)
    {
        window.location= page;
    }
</script>


<script>
 
    var date = new Date();
    var options = {weekday: "long", year: "numeric", month: "long", day: "2-digit"};
    var ladate=document.getElementById("ladate");

        ladate.innerText=date.toLocaleDateString("fr-FR", options);
       

    $({ Counter: 0 }).animate({
      Counter: $('.compteur').text()
    }, {
      duration: 1000,
      easing: 'swing',
      step: function() {
        $('.compteur').text(Math.ceil(this.Counter));
      }
});

$({ Counter: 0 }).animate({
      Counter: $('.compteur1').text()
    }, {
      duration: 1000,
      easing: 'swing',
      step: function() {
        $('.compteur1').text(Math.ceil(this.Counter));
      }
});
$({ Counter: 0 }).animate({
      Counter: $('.compteur2').text()
    }, {
      duration: 1000,
      easing: 'swing',
      step: function() {
        $('.compteur2').text(Math.ceil(this.Counter));
      }


    });
    $({ Counter: 0 }).animate({
      Counter: $('.compteurqte').text()
    }, {
      duration: 2000,
      easing: 'swing',
      step: function() {
        $('.compteurqte').text(Math.ceil(this.Counter));
      }


    });
    
    const Produits=[
                {libele:'Mangue',prix:140000},
                {libele:'Orange',prix:100000},
                {libele:'Banane',prix:200000},
                {libele:'Papaye',prix:50000},
            ];
            var lab=[];
            var prix=[];
            Produits.forEach(p=>{
                lab.push(p.libele)
                prix.push(p.prix)
            })
            console.log(lab);
            var ctx=document.getElementById('myChart')
            var ctx2=document.getElementById('myChart2')
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: lab,
                    datasets: [{
                        label: 'Le Prix:',
                        data: prix,
                        minBarLength: 2,
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
        });

            var myChart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: lab,
                    datasets: [{
                        label: 'Le Prix:',
                        data: prix,
                        minBarLength: 2,
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
        });
</script>
@endsection
        
     