@extends('layout.index')

@section('content')

<!doctype html>
<html lang="en"> 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SAKA</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
</head>

<body onload="initialize()">
    <!-- ============================================================== -->
    <!-- main wrapper -->
       
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Google Map </h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-11 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="card">
                       <h5 class="card-header">la GéoLocalisation de Médiapex pour le moment Merci</h5>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.520341382641!2d-17.432743185158014!3d14.739689389713982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xec172568563df55%3A0x310680d0c878575a!2zTcOpZGlhcGV4!5e0!3m2!1sfr!2ssn!4v1615995617568!5m2!1sfr!2ssn" width="600" height="450" style="border:2;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
               
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="../assets/libs/js/main-js.js"></script>
    <script src="../assets/libs/js/gmaps.min.js"></script>
    <script src="../assets/libs/js/google_map.js">
    </script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBUb3jDWJQ28vDJhuQZxkC0NXr_zycm8D0&amp;sensor=true"></script>
</body>
 

</html>

@endsection

