@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Mes diagnostics</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('diagnostics.create') }}">Enregistrer un nouveau diagnostic</a>
            </div>
        </div>
    </div>
    <style>
        
    </style>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div> 
    
        @endif
    
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Description</th>
            <th width='275px'>Action</th>
        </tr>
        @foreach ($diagnostics as $diagnostic)
        <tr>
            <td>{{ $diagnostic->id }}</td>
            <td>{{ $diagnostic->date }}</td>
            <td>{{ $diagnostic->description }}</td>
            <td>
            <form action="{{ route('diagnostics.destroy',$diagnostic->id) }}" method="POST">   
                    <a class="btn btn-info" href="{{ route('diagnostics.show',$diagnostic->id) }}">Voir</a>    
                    <a class="btn btn-primary" href="{{ route('diagnostics.edit',$diagnostic->id) }}">Modifier</a>   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
            
        @endforeach
    </table>



@endsection