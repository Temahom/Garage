@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste Acteurs</h2>
            </div>
            <div class="pull-right py-3">
                 <a class="btn btn-success" href="{{ route('actors.create') }}">Ajouter Acteur</a>
            </div>
        </div>
    </div>
    <style>
        svg{
            display: none;
        }
    </style>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div> 
    
        @endif
    <div class="row">
    <div class="col-lg-11 col-md-12">
        <table class="table table-striped table-hover col-md-12">
            <thead class="" style="background-color: #4656E9;">
        <tr>
            <th style="color: white;">Prenom | Nom</th>
            <th style="color: white;">Aresse Email</th>
            <th style="color: white;">Role</th>
            <th style="color: white;">Action</th>
        </tr>
            </thead>
        @foreach ($actors as $actor)
        <tr>
            <td onclick="showActor({{ $actor->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $actor->name}}</td>
            <td onclick="showActor({{ $actor->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $actor->email}}</td>
            <td onclick="showActor({{ $actor->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $actor->role()->first()->role}}</td>
            <td>
                    <a class="btn btn-primary  p-0 pr-2 pl-2" href="{{ route('actors.edit',$actor->id) }}"><i class="fas fa-edit"></i></a>
                    <button type="button" class="btn btn-danger  p-0 pr-2 pl-2" data-toggle="modal" data-target="#exampleModal{{ $actor->id }}">
                        <i class="fas fa-trash"></i>
                    </button> 
                    <div class="modal fade" id="exampleModal{{ $actor->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h5>Voulez vous vraiment supprimer <strong>la {{ $actor->marque }} de {{ $actor->matricule }} de liste des actors</strong>  ?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <form action="{{route('actors.destroy',$actor->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                
            </td>
        </tr>    
        @endforeach  
    </table>
</div>
</div>
<div class="row">
    <div class="col-md-12 mt-3 d-flex justify-content-center">
        {!! $actors->links() !!}
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
    function showActor(id)
    {
        window.location = 'actors/' + id ;
    }
</script>

@endsection      
                