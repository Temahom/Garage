@extends('layout.index')
@php
setlocale(LC_TIME, "fr_FR", "French");
$date = new DateTime('now', new DateTimeZone('UTC'));
use Carbon\Carbon;
  $clients=\App\Models\Client::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
  $chiffres=\App\Models\Devi::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('cout');
 
  $client30=\App\Models\Client::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-1)->count();
  $chiffre30=\App\Models\Devi::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-1)->sum('cout');
 
  $client60=\App\Models\Client::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-2)->count();
  $chiffre60=\App\Models\Devi::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-2)->sum('cout');
 $total=$chiffres+$chiffre30+$chiffre60;
@endphp
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
<link rel="stylesheet" href="/assets/libs/css/clock.css">
<style>
    #cercle .card {
      
        justify-content: center;
        align-self: center;
        align-items: center;
        align-content: center;
     
      
    }
    .time{
        align-self: center;
        margin-top:30% !important;
    }
    .clw{
        color: white !important;
    }
    #block-1 .card{
        background-color: #a0b92f !important;
        color: white !important;
    
    }
    #block-2 .card{
        background-color: #a85e7b !important;
        color: white !important;
    
    }

    #block-3 .card{
        background-color: #3a6297 !important;
        color: white !important;
    
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
    
    
</style>
<div class="row">
    
    <div class="col-xl-3 col-md-6  col-lg-4 col-sm-12 " id="cercle">
        <div class="card">
            <div class="card-body">
                    <div id="clock">
  
                    </div>
                </div> 
               
          
           
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-lg-4 col-sm-12 col-12" id="block-1" style="text-align: center">
        <div class="card">
            <div class="card-body " >
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
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="block-2" style="text-align: center">
        <div class="card">
            <div class="card-body " >
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
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="block-3" style="text-align: center">
        <div class="card">
            <div class="card-body " >
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
<div class="row">
    <span class="history" style="width: 20%">
        <h4>Historiques</h4>
    </span>

    
</div>
<div class="row">
<div class="col-xl-6 col-lg-6 col-md-10 col-sm-12 col-6 mt-5">
    <div class="card">
        <h5 class="card-header">Nombre de Clients par Mois</h5>
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
 {{-- fin tableau de Vieillissment du clients --}}

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<script src="assets/libs/js/clock.js"></script>
<script>
 
    var date = new Date();
    var options = {weekday: "long", year: "numeric", month: "long", day: "2-digit"};
    var ladate=document.getElementById("ladate");

        ladate.innerText=date.toLocaleDateString("fr-FR", options);
        var heurre=document.getElementById("heurre");
        var minute=document.getElementById("minute");
        var seconde=document.getElementById("seconde");

            // declarations des variables pour la recupertaion de l'heurre d'aujourd'huit
          
           
          setInterval(
            function(){
                
                var date1 = new Date();
                heurre.innerText=date1.getHours();
                minute.innerText=date1.getMinutes();
                seconde.innerText=date1.getSeconds();
              
                //alert(date.getSeconds)
            },1000);


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

</script>
@endsection
        
     