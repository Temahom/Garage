<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/libs/css/style.css">
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
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
    <!-- login page  -->
    <!-- ============================================================== -->
    
    <div class="blur">
        <img src="/assets/images/bg_saka.jpg" >
    </div>
        <div class="splash-container">
        
        <div class="card ">
            <div class="card-header text-center"><a href="/"><img style="height: 100px;width: auto;" class="logo-img" src="/assets/images/logo.png" alt="logo"></a><span class="splash-description" style="color: #808183">Veillez entrer vos informations.</span></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login')}}">
                        @csrf
                        <div class="form-group">
                            <input class="form-control form-control-lg" name="email" id="username" type="text" placeholder="Nom utilisateur" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" name="password" id="password" type="password" placeholder="Mot de Passe">
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Se souvenir de moi</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Se Connecter</button>
                    </form>
                    <label class="mt-3 text-center" style="margin-left: 30%;">
                        <span><a href="{{route('password.request')}}">Forgot password?</a></span>
                    </label>
                </div>
            </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>