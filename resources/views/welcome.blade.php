@extends('layout.index')
@php
setlocale(LC_TIME, "fr_FR", "French");
$date = new DateTime('now', new DateTimeZone('UTC'));
use Carbon\Carbon;
  $clients=\App\Models\Client::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
@endphp
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
<style>
    #cercle .card {
        width: 200px;
        height: 200px;
        border: 2px solid #1891ea;
        border-radius: 50% !important;
        justify-content: center;
        align-self: center;
        align-items: center;
        align-content: center;
        box-shadow: 2px 5px 5px 1px #888888;
      
    }
    .time{
        align-self: center;
        margin-top:30% !important;
    }
    .clw{
        color: white !important;
    }
    #block-1 .card{
        background-color: #cc00cc !important;
        color: white !important;
    
    }
    #block-2 .card{
        background-color: #e0103d !important;
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
                    <h3 class="text-center mt-3 time"><span id="heurre"></span>h: <span id="minute"></span>mn: <span id="seconde"></span>s</h3>
                    <h5 class="text-center" style="text-transform: capitalize;" id="ladate"></h5>
                </div> 
               
          
           
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-lg-4 col-sm-12 col-12" id="block-1">
        <div class="card">
            <div class="card-body " >
                <div class="metric-value d-inline-block">
                    <p>
                    <span class="clw compteur"  style="font-weight: bold; font-size:30px;">{{\App\Models\Client::count()}}</span>
                    <span class="clw" style="font-weight: bold;margin-left: 10px;font-size:20px;">{{\App\Models\Client::count()>1?"Clients":"Client"}}</span>
                </p>
            </div>
                
    
            </div>
            <div id="sparkline-revenue"></div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="block-2">
        <div class="card">
            <div class="card-body " >
                <div class="metric-value d-inline-block">
                    <p>
                    <span class="clw compteur1" style="font-weight: bold; font-size:30px;" >{{\App\Models\Voiture::count()}}</span>
                    <span class="clw" style="font-weight: bold;margin-left: 10px;font-size:20px;">{{\App\Models\Voiture::count()>1?"Voitures":"Voiture"}}</span>
                </p>
            </div>
                
    
            </div>
            <p style="margin:10px">Lorem ipsum dolor  iste exercitationem aperiam 
                consequuntur aspernatur distinctio similique recusandae. Non quasi saepe dolore ullam perferendis
                 nulla ab consequatur nobis?</p>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12" id="block-2">
        <div class="card">
            <div class="card-body " >
                <div class="metric-value d-inline-block">
                    <p>
                    <span class="clw compteur2" style="font-weight: bold; font-size:30px;">{{\App\Models\Intervention::count()}}</span>
                    <span class="clw" style="font-weight: bold;margin-left: 10px;font-size:20px;">{{\App\Models\Intervention::count()>1?"Interventions":"Intervention"}}</span>
                </p>
            </div>
                
    
            </div>
            <p style="margin:10px"></p>
        </div>
    </div>
</div>
<div class="row">
    <span class="history" style="width: 20%">
        <h4>Historiques</h4>
    </span>

    
</div>
<div class="row">
<div class="col-xl-9 col-lg-12 col-md-10 col-sm-12 col-12 mt-5">
    <div class="card">
        <h5 class="card-header">Nombre de Clients par Trimestre</h5>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-light">
                        <tr class="border-0">
                            <th class="border-0">#</th>
                            <th class="border-0">Clients</th>
                            <th class="border-0">Chiffre d'affaire</th>
                            <th class="border-0">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{$clients}} </td>
                            <td>5 000 000 </td>
                            <td><span class="badge-dot badge-success mr-1"></span>Validé </td>
                        </tr>
                        
                        <tr>
                            <td colspan="9"><a href="#" class="btn btn-outline-light float-right">Voir Detailles</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>

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
        
     