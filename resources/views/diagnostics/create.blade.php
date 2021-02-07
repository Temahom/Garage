<!DOCTYPE html>
<html>
    <head>
        <title>SAKA</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        <div class="container">
            <div class="card-header"><h2>diagnostic</h2></div>
                    <div class="card-body">
                        <form action="{{ route('diagnostics.store') }}" method="POST">
                        @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif
                            <table class="table table-bordered" id="dynamicAddRemove">  
                                <thead class="" style="background-color: #4656E9;">
                                    <tr>
                                        <th style="color: white;">Titre</th>
                                        <th style="color: white;">Description</th>
                                        <th style="color: white;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>  
                                        <td>
                                            <input type="text" name="plusdechamps[0][title]" placeholder="Entrer title" class="form-control" />
                                        </td>
                                        <td>
                                            <input style="width: 20px" type="radio" name="plusdechamps[0][description]" value="trés urgent" class="form-control" />
                                            <input style="width: 20px" type="radio" name="plusdechamps[0][description]" value="pas urgent" class="form-control" />
                                            <input style="width: 20px" type="radio" name="plusdechamps[0][description]" value="peut attendre" class="form-control" />
                                        </td>  
                                        <td>
                                            <button type="button" name="add" id="add-btn" class="btn btn-success">Ajouter un diagnostic</button>
                                        </td>  
                                    </tr>  
                                </tbody>
                            </table> 
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </form>
                    </div>
                </div>
        </div>
        <script type="text/javascript">
            var i = 0;
            $("#add-btn").click(function(){
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="plusdechamps['+i+'][title]" placeholder="Enter title" class="form-control" /></td><td><input style="width: 20px" type="radio" name="plusdechamps['+i+'][description]" value="trés urgent" class="form-control" /><input style="width: 20px;" type="radio" name="plusdechamps['+i+'][description]" value="pas urgent" class="form-control" /><input style="width: 20px" type="radio" name="plusdechamps['+i+'][description]" value="peu attendre" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Supprimer</button></td></tr>');
            });
            $(document).on('click', '.remove-tr', function(){  
            $(this).parents('tr').remove();
            });  
        </script>
    </body>
</html>