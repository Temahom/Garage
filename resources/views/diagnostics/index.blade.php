@extends('layout.index')
  
@section('content')

<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Tous les Diagnostics</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-secondary" href="{{route('diagnostics.create')}}">Nouveau Diagnostic</a>
		</div>
	</div>
</div>
<br>
<br>

@if($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{$message}}</p>
		</div>
	@endif

	<div class="row">
	<div class="col-md-12 col-lg-11">
	<table id="example4" class="table table-striped table-hover">
		<thead class="" style="background-color: #4656E9;">
			<tr>
				<th style="color: white;">Localisation de la panne</th>
				<th style="color: white;">Appréciation</th>
				<th style="color: white;">Action</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($diagnostic as $diagnostic)
		
			<tr>
				<td onclick="showDiagnostic({{ $diagnostic->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $diagnostic->title }}</td>
				<td onclick="showDiagnostic({{ $diagnostic->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $diagnostic->description }}</td>
				<td>

					<a class="btn btn-primary p-0 pr-2 pl-2" href="{{ route('diagnostics.edit',$diagnostic->id)}}"><i class="fas fa-edit"></i></a>
					<button type="button" class="btn btn-danger p-0 pr-2 pl-2" data-toggle="modal" data-target="#exampleModal{{ $diagnostic->id }}">
						<i class="fas fa-trash"></i>
					</button>

							<div class="modal fade" id="exampleModal{{ $diagnostic->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-body">
											<h5>Voulez vous supprimer: <strong>{{ $diagnostic->title }} {{ $diagnostic->description }}</strong>  ?</h5>
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
							</div>

				</td>
			</tr>
		
		@endforeach
		</tbody>
	</table>
	</div>
	</div>
	
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

	<script>
		function showDiagnosti(id)
		{
			window.location = 'diagnostics/' + id ;
		}
	</script>
@endsection