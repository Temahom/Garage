<!doctype html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/libs/css/style.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="/assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="/style-table.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
    {{-- ---------  select2------------------------------------ --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="select2.css">
    <link rel="stylesheet" href="select2-bootstrap.css">
    {{-- ------------------------end-------------------------- --}}
    <title>Garage</title>
</head>
<style>


    .dashboard-main-wrapper{
        background-color: white;
    }
    .footer{

        background:white;
        position:fixed;
        bottom:0;
        width:100%
    }
    .capitalize{
      text-transform: capitalize;
    }

    .nav-divider{
        color: rgb(0, 0, 0) !important;
        text-align: center;
        background-color: rgb(255, 255, 255) !important;
        border-radius: 15px !important;
    }
    .marquee-rtl {
        max-width: 100% ;                      /* largeur de la fenêtre */
        margin: 1em auto 2em;
        overflow: hidden;                     /* masque tout ce qui dépasse */
        padding-right: 5px;
    }
    .marquee-rtl > :first-child {
        display: inline-block;                /* modèle de boîte en ligne */
        padding-right: 2em;                   /* un peu d'espace pour la transition */
        padding-left: 100%;                   /* placement à droite du conteneur */
        white-space: nowrap;                  /* pas de passage à la ligne */
        animation: defilement-rtl 15s infinite linear;
        animation-name: defilement-rtl;       /* référence à la règle @keyframes mise en oeuvre */
        animation-delay: 3s;                 /* valeur à ajuster suivant la longueur du message */
        animation-iteration-count: infinite;  /* boucle continue */
        animation-timing-function: linear;    /* pas vraiment utile ici */
    }
    @keyframes defilement-rtl {
        0%  {
                transform: translate3d(0,0,0);      /* position initiale à droite */
            }
        100% {
            transform: translate3d(-100%,0,0);  /* position finale à gauche */
  }
}
    
</style>

    

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
       
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
                 <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top" style="width: auto !important;">
                <a class="navbar-brand" href="/">
                    <img style="height: 50px;width: auto;" class="logo-img" src="/assets/images/logo.png" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div class="marquee-rtl">
                                <!-- le contenu défilant -->
                                <div>Le message que l'on veut voir défilé horizontalement...</div>
                            </div>                 
                        </li>
                        @php
                            use Carbon\Carbon;
                            $notifications= App\Models\Intervention::where('diagnostic_id','=',null)->where('devis_id','=',null)->where('summary_id','=',null)->where('technicien','=',Auth::id())->get();
                            //dd($notifications);
                        @endphp
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Notifications <span class="badge badge-danger">{{count($notifications)==0?'0':count($notifications)}}</span></div>
                                    <div class="notification-list">
                                        <div class="list-group">
                                            @foreach ($notifications as $notification)
                                                <a href="/voitures/{{$notification->voiture_id}}/interventions/{{$notification->id}}" class="list-group-item list-group-item-action active">
                                                    <div class="notification-info">
                                                    @if (isset($notification->user()->first()->image))
                                                    <div class="notification-list-user-img"><img src="{{asset('images/'.$notification->user()->first()->image)}}" alt="" class="user-avatar-md rounded-circle"></div>
                                                    @else
                                                        <div class="notification-list-user-img"><img src="https://ui-avatars.com/api/?background=random&color=fff&name={{ $notification->user()->first()->name}}" alt="" class="user-avatar-md rounded-circle"></div>
                                                    @endif
                                                        <div class="notification-list-user-block"><span class="notification-list-user-name">{{$notification->user()->first()->name}}</span>Vous a attribué {{$notification->type == 'intervention'? 'une':'un'}}  <span class="badge bg-secondary">{{$notification->type}}</span>
                                                            <div class="notification-date">Il Y'a {{Carbon::now()->diffInMinutes($notification->created_at)}} minutes</div>
                                                        </div>
                                           
                                                </div>
                                            </a> 
                                            @endforeach
                                           
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-footer"> <a href="#">Voir toutes les notifications</a></div>
                                </li>
                            </ul>
                        </li>
                        @auth
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{Auth::user()?Auth::user()->email:null}}" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"> {{Auth::user()->name?Auth::user()->name:null}}</h5>
                                   
                                    <span class="status"></span><span class="ml-2">{{Auth::user()->role->role}}</span>
                                </div>
                                <form action="{{route ('logout')}}" method="post">
                                    @csrf
                                <button class="dropdown-item" type="submit"><i class="fas fa-power-off mr-2"></i>Deconnexion</button>
                            </form>
                            </div>
                        </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
<<<<<<< HEAD
        <!-- ==============================================================//   sidebar-dark // style="background-color: #068c94;" --> 
        <div class="nav-left-sidebar " style="background-color: #1b4f52;">
=======
        <!-- ==============================================================//   sidebar-dark  --> 
        <div class="nav-left-sidebar" style="background-image: linear-gradient( to top,#2b2a34, #0E0C28);">
>>>>>>> 63935c0ac5d53677dbebbad6bb25d66acd4b7176
            <br>
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider" style="font-size: 20px">
                               Menu
                            </li><br>

                            <li class="nav-item" style="padding-top: 8px">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-client" aria-controls="submenu-client"><i class="icon-user"></i>Clients<span class="badge badge-success"></span></a>
                                <div id="submenu-client" class="collapse submenu" style="background-color: #1b4f52;">
                                    <ul class="nav flex-column"  >
                                        <li class="nav-item">
                                            <a class="nav-link" href="/clients" style="color: #fcfcfc;">Liste Clients</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/clients/create" style="color: #fcfcfc;">Ajouter Client</a>
                                        </li>
                                    </ul>    
                                </div>
                            </li>

                            <li class="nav-item " style="padding-top: 5px">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-voiture" aria-controls="submenu-voiture"><i class="fa fa-fw fa-car"></i>Voitures<span class="badge badge-success"></span></a>
                                <div id="submenu-voiture" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/voitures">Liste voitures</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/voitures/create">Ajouter voiture</a>
                                        </li>
                                    </ul>    
                                </div>
                            </li>
                            <li class="nav-item "  style="padding-top: 5px">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-acteur" aria-controls="submenu-acteur"><i class="icon-people"></i>Acteurs<span class="badge badge-success"></span></a>
                                <div id="submenu-acteur" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/actors">Liste Acteurs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/actors/create">Ajouter Acteur</a>
                                        </li>
                                    </ul>    
                                </div>
                            </li>
                            <li class="nav-item "  style="padding-top: 5px">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-rv" aria-controls="submenu-rv"><i class="fas fa-calendar"></i>Agenda<span class="badge badge-success"></span></a>
                                <div id="submenu-rv" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/fullcalendar">Liste RV</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" target="_blank" href="https://calendar.google.com/calendar/u/0?cid=cmI1dmlocnM1OWwwYjZkY3E0dnQ2MzFwOG9AZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ">Ajouter rv</a>
                                        </li>
                                    </ul>    
                                </div>
                            </li>
                           <li class="nav-item "  style="padding-top: 5px">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-produit" aria-controls="submenu-produit"><i class="icon-briefcase"></i>Produits<span class="badge badge-success"></span></a>
                                <div id="submenu-produit" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/produits">Liste Produits</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/produits/create">Ajouter Produit</a>
                                        </li>
                                     <!--   <li class="nav-item">
                                            <a class="nav-link" href="/produits.creer">Creer un nouveau Produit</a>
                                        </li>-->
                                    </ul>    
                                </div>
                            </li>

                            <li class="nav-item "  style="padding-top: 5px">
                                <a class="nav-link active" href="/google_map"><i class="nav-icon fa-fw fas fa-position"></i>Google Map<span class="badge badge-success"></span></a>
                            </li> 

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <div class="ecommerce-widget">

                        <div class="row">
                             <div style="width: 100%; margin-left:30px;" > 
                                @yield('content')
                            </div> 
                            <div class="footer" style="text-align: center;">
                                <div class="container-fluid" style="text-align: center;margin-left:15%;">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            Copyright ©  {{Date('Y')}} SAKA.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script>
       var btns= document.querySelectorAll(".hide_delete")
            btns.forEach(b=>{
                b.style.display="none";
            })
    </script>

    <!-- bootstap bundle js -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="/assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="/assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="/assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="/assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="/assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="/assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="/assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="/assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="/assets/libs/js/dashboard-ecommerce.js"></script>
    <script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="/assets/libs/js/main-js.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.0/countUp.min.js" integrity="sha512-E0zfDwA1CopT4gzJmj9tMpd7O6pTpuybTK58eY1GwqptdasUohyImuualLt/S5XvM8CDnbaTNP/7MU3bQ5NmQg==" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="/assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/vendor/datatables/js/data-table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    {{---------------------select2---------------------- --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{------------------------end----------------------------- --}}
    
</body>
 
</html>