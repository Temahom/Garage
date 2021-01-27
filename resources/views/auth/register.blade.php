<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Creaion de compte</title>
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
    </style>
</head>
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

<body>
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
    <form class="splash-container" action="{{route('register')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h3 class="mb-1">Inscription</h3>
                <p>Veuillez Remplir les informations .</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="name" required="" placeholder="Nom Utlisatuer" autocomplete="off">
                    @error('name')
                        <span class="invalid-feedbak" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="email" required="" placeholder="E-mail" autocomplete="off">
                    @error('email')
                    <span class="invalid-feedbak" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" id="pass1" name="password" type="password" required="" placeholder="Mot de Passe">
                    @error('password')
                    <span class="invalid-feedbak" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" required name="password_confirmation" placeholder="Confirmer le  Mot de Passe">
                    @error('password_confirmation')
                    <span class="invalid-feedbak" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group pt-2">
                    <button class="btn btn-block btn-primary" type="submit">Enregister </button>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox"><span class="custom-control-label">By creating an account, you agree the <a href="#">terms and conditions</a></span>
                    </label>
                </div>
                
            </div>
            <div class="card-footer bg-white">
                <p>Déjà inscrit ? <a href="{{route('login')}}" class="text-secondary">Se connecter.</a></p>
            </div>
        </div>
    </form>
</body>

 
</html>