<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Saka modification du mot de passe</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
      html,
    body {
        height: 100%;
       

    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    .card{
        /*-bottom:10px solid #2CA6A4;*/
      

        }
        .blur{
            position: absolute;
            background-attachment: fixed;
            filter: blur(8px);
            -webkit-filter: blur(8px);
        }
        .blur img{
           
            height: 100vh;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- forgot password  -->
    <!-- ============================================================== -->
    <div class="blur">
        <img src="/assets/images/bg_saka.jpg" >
    </div>
    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center"><img class="logo-img" src="../assets/images/logo.png" alt="logo"><span class="splash-description">Veillez entrer vos informations.</span></div>
            <div class="card-body">
                <form method="POST" action="{{route('password.request')}}">
                    @csrf
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                    <div class="form-group">
                        <input class="form-control form-control-lg" type="email" name="email" required="" placeholder="Votre Email" autocomplete="off">
                    </div>
                    <div class="form-group pt-1">
                        <button class="btn btn-block btn-primary" type="submit">Modifier le mot de passe </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <span>Je n'ai pas de compte <a href="{{route('register')}}">S'inscrire</a></span>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end forgot password  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

 
</html>