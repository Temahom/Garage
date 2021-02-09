@extends('layout.index')
  
@section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
  
        
        
        <div class="container">
                    <div class="card-body">
                        <form action="{{ route('voitures.interventions.diagnostics.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
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
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="plusdechamps[0][description]" value="trés urgent" class="custom-control-input" ><span class="custom-control-label">Trés urgent</span>
                                            </label>
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="plusdechamps[0][description]" value="pas urgent" class="custom-control-input" ><span class="custom-control-label">Pas urgent</span>
                                            </label>
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" name="plusdechamps[0][description]" value="peut urgent" class="custom-control-input" ><span class="custom-control-label">Peut urgent</span>
                                            </label>
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
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
        <script >
            var i = 0;
            $("#add-btn").click(function(){
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="plusdechamps['+i+'][title]" placeholder="Enter title" class="form-control" /></td><td> <label class="custom-control custom-radio custom-control-inline"><input type="radio" name="plusdechamps['+i+'][description]" value="trés urgent" class="custom-control-input" ><span class="custom-control-label">Trés urgent</span></label> <label class="custom-control custom-radio custom-control-inline"><input type="radio" name="plusdechamps['+i+'][description]" value="pas urgent" class="custom-control-input" ><span class="custom-control-label">Pas urgent</span></label> <label class="custom-control custom-radio custom-control-inline"><input type="radio" name="plusdechamps['+i+'][description]" value="peut attendre" class="custom-control-input" ><span class="custom-control-label">Peut attendre</span></label></td><td><button type="button" class="btn btn-danger remove-tr">Supprimer</button></td></tr>');
            });
            $(document).on('click', '.remove-tr', function(){  
            $(this).parents('tr').remove();
            });  
        </script>
@endsection
