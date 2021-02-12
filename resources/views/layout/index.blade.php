<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/libs/css/style.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="/assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="/assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
     <!-- Table CSS -->
    <link rel="stylesheet" type="text/css" href="../style-table.css">
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
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
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
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Notifications <span class="badge badge-danger">20</span></div>
                                    <div class="notification-list">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action active">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="assets/images/avatar-2.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">{{Auth::user()->name}}</span>Vous a attribuer une taches.
                                                        <div class="notification-date">Il y'a 2 min </div>
                                                    </div>
                                                </div>
                                            </a>
                                           
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-footer"> <a href="#">Voir toutes les notifiacations</a></div>
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
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <br>
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Clients</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider" style="font-size: 25px">
                               Menu
                            </li><br>

                            <li class="nav-item ">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-client" aria-controls="submenu-client"><i class="fa fa-fw fa-user-circle"></i>Clients<span class="badge badge-success">6</span></a>
                                <div id="submenu-client" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/clients">Liste Clients</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/clients/create">Ajouter Client</a>
                                        </li>
                                    </ul>    
                                </div>
                            </li>

                            <li class="nav-item " style="padding-top: 5px">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-voiture" aria-controls="submenu-voiture"><i class="fa fa-fw fa-car"></i>Voitures<span class="badge badge-success">6</span></a>
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
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-acteur" aria-controls="submenu-acteur"><i class="fas fa-users"></i>Acteurs<span class="badge badge-success">6</span></a>
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
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-produit" aria-controls="submenu-produit"><i class="fa fa-fw fa-briefcase"></i>Produits<span class="badge badge-success">6</span></a>
                                <div id="submenu-produit" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/produits">Liste Produits</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/produits/create">Ajouter Produit</a>
                                        </li>
                                    </ul>    
                                </div>
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
                            <div style="width: 100%; padding-left: 30px" >
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
    <script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.0/countUp.min.js" integrity="sha512-E0zfDwA1CopT4gzJmj9tMpd7O6pTpuybTK58eY1GwqptdasUohyImuualLt/S5XvM8CDnbaTNP/7MU3bQ5NmQg==" crossorigin="anonymous"></script>
</body>
 
</html>