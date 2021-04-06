@extends('layout.index')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"
        integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="/assets/libs/css/clock.css">

    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css ')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}} ">

    {{-- SweetAlert2 --}}
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css')}} ">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/skin-blue.min.css')}} ">
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

    </style>


    <!-- ---------------------------Horloge, nb client, nb voiture nb intervention -------------------------------------- -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row">

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
                <div class="card" onclick="show('clients')">
                    <div class="card-body "><br>
                        <div class="metric-value d-inline-block">
                            <p>
                                <span class="clw compteur"
                                    style="font-weight: bold; font-size:30px;">{{ \App\Models\Client::count() }}</span>
                                <span class="clw"
                                    style="font-weight: bold;margin-left: 10px;font-size:20px;">{{ \App\Models\Client::count() > 1 ? 'Clients' : 'Client' }}
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
       

        
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
               <h3>{{ App\Models\Voiture::count() }}</h3>  

                <p>Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
                <a href="/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
         </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                     <h3>{{ App\Models\Voiture::count() }}<sup style="font-size: 20px"></sup></h3> 
        
                        <p>Category</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list"></i>
                    </div>
                     <a href="{{ route('produits.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> 
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                       <h3>{{ App\Models\Produit::count() }}</h3>   
                        <p>Product</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cubes"></i>
                    </div>
                    <a href="{{ route('produits.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>  
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                       <h3>{{ App\Models\Client::count() }}</h3>   
        
                        <p>Customer</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                         <a href="{{ route('clients.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>  
                </div>
            </div>
            <!-- ./col -->
        </div>
        

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-navy">
                    <div class="inner">
                         <h3>{{ App\Models\Voiture::count() }}</h3>    
        
                        <p>Sales</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                       <a href="{{ route('produits.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>  
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                          <h3>{{ App\Models\Voiture::count() }}<sup style="font-size: 20px"></sup></h3>  
        
                        <p>Supplier</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                       <a href="{{ route('produits.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>  
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-maroon">
                    <div class="inner">
                       <h3>{{ App\Models\Produit::count() }}</h3> 
        
                        <p>Product In</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-plus"></i>
                    </div>
                        <a href="{{ route('produits.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>  
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <div class="card-body">
                <!-- small box -->
                <div class="small-box bg-gray">
                    <div class="inner">
                         <h3>{{ App\Models\Voiture::count() }}</h3>   
        
                        <p>Product Out</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-minus"></i>
                    </div>
                        <a href="{{ route('produits.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>  
                </div>
            </div>
        </div>
            <!-- ./col -->
            <div id="container" class=" col-xs-6"></div>
        </div>
    






        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
        integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
        crossorigin="anonymous"></script>
    <script src="assets/libs/js/clock.js"></script>
   
    <!-- morris js -->
    <script src="/assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="/assets/vendor/charts/morris-bundle/morris.js"></script>
    <script src="/assets/vendor/charts/morris-bundle/morrisjs.html" type="text/html"></script>
    <script src="assets/libs/js/les_courbes.js"></script>

   


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

    <!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{  asset('assets/bower_components/jquery/dist/jquery.min.js') }} "></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{  asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>
<!-- AdminLTE App -->
<script src="{{  asset('assets/dist/js/adminlte.min.js') }}"></script>



@endsection
