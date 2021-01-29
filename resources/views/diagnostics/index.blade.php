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
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Description</th>
                <th width='275px'>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diagnostics as $diagnostic)
            <tr>
                <td>{{ $diagnostic->id }}</td>
                <td>{{ $diagnostic->date }}</td>
                <td>{{ $diagnostic->description }}</td>
                <td style="display: flex">
                    <a class="btn btn-info mr-1" href="{{ route('diagnostics.show',$diagnostic->id) }}"><i class="fas fa-eye"></i></a>    
                    <a class="btn btn-primary  mr-1" href="{{ route('diagnostics.edit',$diagnostic->id) }}"><i class="fas fa-edit "></i></a>   
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $diagnostic->id }}">
						<i class="fas fa-trash mr-2"></i>
					</button>

					<div class="modal fade" id="exampleModal{{ $diagnostic->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-body">
									<h5>Voulez vous vraiment supprimer <strong>la {{ $diagnostic->date }} et la {{ $diagnostic->description }} de la diagnostique</strong>  ?</h5>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
									<form action="{{route('diagnostics.destroy',$diagnostic->id)}}" method="POST">
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
        </tbody>
    </table>


    {{ $diagnostics->links() }}

@endsection