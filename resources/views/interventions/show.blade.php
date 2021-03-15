@extends('layout.index')

@section('content')
@if($message = Session::get('devis-send'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{$message}}</strong>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
  </div>
@endif
<!-- INFORMATIONS VOITURE  -->
<div class="row">
	<div class="col-md-5 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">

		<div class="row">

			<div class="col-md-2 col-sm-3 text-center pt-4">
				<img style="height: 50px;width: auto;" class="" src="/assets/images/car.png" alt="logo">
			</div>

			<div class="col-md-10 col-sm-10">

				<div style="font-size: 20px">
					<a href="{{route('voitures.show',['voiture'=>$voiture->id])}}" style="color: #2EC551">
						{{ $voiture->matricule }}
					</a>
					<span style="font-size: 12px;">
						( De<a href="{{route('clients.show',['client'=>$voiture->client_id])}}" style="color: #2EC551">
							<i class="fas fa-user"></i>
							{{ $voiture->client()->first()->prenom.' '.$voiture->client()->first()->nom}}
						</a>)
					</span>

				</div>

				<div style="font-size: 14px;"> {{ $voiture->marque}} - {{ $voiture->model}} - {{ $voiture->annee}}</div>
				<div style="font-size: 14px;"> {{ $voiture->transmission}} - {{ $voiture->carburant}}</div>			
				<div style="font-size: 14px;"> {{ $voiture->puissance}} cheveaux - {{ $voiture->kilometrage}} km</div>		
				<div class="text-right" style="font-size: 12px;">
					<a class="text-primary mr-1" href="{{ route('voitures.edit',$voiture->id)}}">Modifier</a> 
					<button type="button" class="text-danger" style="border: none; cursor: pointer" data-toggle="modal" data-target="#exampleModal{{ $voiture->id }}">
						Supprimer
					</button>
					<div class="modal fade" id="exampleModal{{ $voiture->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-body">
									<h5>Voulez vous supprimer: <strong>{{ $voiture->matricule }}</strong>  ?</h5>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
									<form action="{{route('voitures.destroy',$voiture->id)}}" method="POST">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger">Supprimer</button>
									</form>
							</div>
							</div>
						</div>
					</div>	
				</div>

			</div>

		</div>

	</div>
</div>




<!-- ============================================================== -->
<!-- TAB INTERVENTION  -->
<!-- ============================================================== -->
<div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px ">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
		<div class="section-block">
			<h2 class="section-title py-4" style="text-align: center">INTERVENTION</h2>
			<!-- DATE DEBUT DATE FIN  -->
			<div class="row">
				<div class="col-md-3">
					<h4 style="display: inline-block">Debut : </h4> {{ $intervention->debut }}
				</div>
				<div class="col-md-3">
					<h4 style="display: inline-block">Fin : </h4> {{ $intervention->fin }}
				</div>
			</div>
			<!-- FIN DATE DEBUT DATE FIN  -->
		</div>
		<div class="tab-outline">
			<ul class="nav nav-tabs" id="myTab2" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="home" aria-selected="true">Diagnostic</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="tab-outline-two" data-toggle="tab" href="#outline-two" role="tab" aria-controls="profile" aria-selected="false">Devis</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="tab-outline-three" data-toggle="tab" href="#outline-three" role="tab" aria-controls="contact" aria-selected="false">Résumé Intervention</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent2">



				<!-- ============================================================== -->
				<!-- DIAGNOSTIC  -->
				<!-- ============================================================== -->
				<div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">
					@if ( $intervention->diagnostic_id )
					{
						<div class="row">
							<div class="col-md-12">
								<h2>Constat</h2>
								<p>{{ $diagnostic->constat }}</p>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
									<tr>
										<th scope="col">Code</th>
										<th scope="col">Localisaton</th>
										<th scope="col">Déscription</th>
										<th scope="col">Etat</th>
									</tr>
									</thead>
									<tbody>
										@foreach ($diagnostic['defauts'] as $defaut)
											<tr>
												<th scope="row">{{ $defaut->code }}</th>
												<td>{{ $defaut->localisation }}</td>
												<td>{{ $defaut->description }}</td>
												<td>{{ $defaut->etat }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					}

					<div class="row">
						<div class="col-md-12 mt-3">
							@if ( $intervention->diagnostic_id )
								<a class="btn btn-warning" href="{{ route('voitures.interventions.diagnostics.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Modifier">Modifier</a>
							@else
								<a class="btn btn-primary" href="{{ route('voitures.interventions.diagnostics.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Ajouter">Ajouter</a>
							@endif
						</div>
					</div>
					

				</div>
				<!-- ============================================================== -->
				<!-- FIN DIAGNOSTIC  -->
				<!-- ============================================================== -->



				<!-- ============================================================== -->
				<!-- DEVIS  -->
				<!-- ============================================================== -->
				<div class="tab-pane fade" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-two">
					@if ( $intervention->devis_id )
					{
						<div class="row my-4">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
									<tr>
										<th scope="col">Produit</th>
										<th scope="col">Quantité</th>
										<th scope="col">Prix/1</th>
										<th scope="col">Total</th>
									</tr>
									</thead>
									<tbody>
										<?php  $total = 0 ?>
										@foreach ($devi['item_devis'] as $item)
											<tr>
												<td>{{ $item['produit']->produit }}</td>
												<td>{{ $item['devi_produit']->quantite }}</td>
												<td>{{ number_format($item['produit']->prix1, 0, ",", " " ) }}</td>
												<td><?php echo number_format($item['produit']->prix1 * $item['devi_produit']->quantite, 0, ",", " ") ?></td>
											</tr>
											<?php $total += $item['produit']->prix1 * $item['devi_produit']->quantite ?>
										@endforeach
										<tr>
											<th scope="col" colspan="3">Total</th>
											<th scope="col">{{ number_format($total, 0, ",", " ") }}</th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					}

					<div class="row">
						<div class="col-md-12">
							@if ( $intervention->devis_id )
								<a class="btn btn-warning" href="{{ route('voitures.interventions.devis.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Modifier">Modifier</a>
								<a href="/Pdf/{{$intervention->id}}" target="_blank" class="btn btn-success"><i class="icon-printer"></i> Imprimer</a>
								<a href="/send-devis/{{$intervention->id}}" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"> Envoyer au client</i></a>	
							@else
								<a class="btn btn-primary" href="{{ route('voitures.interventions.devis.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Ajouter">Ajouter</a>
							@endif
						</div>
					</div>

				</div>
				<!-- ============================================================== -->
				<!-- FIN DEVIS  -->
				<!-- ============================================================== -->



				<!-- ============================================================== -->
				<!-- RESUME  -->
				<!-- ============================================================== -->
				<div class="tab-pane fade" id="outline-three" role="tabpanel" aria-labelledby="tab-outline-three">

					<div class="row">
						<div class="col-md-12">
							
						</div>
					</div>
				
					<div class="row">
						<div class="col-md-12">
							@if ( $intervention->summary_id )
								{{-- <p>{{ $summary->resume }}</p> --}}
								<a class="btn btn-warning" href="{{ route('voitures.interventions.summaries.edit',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'summary' => $summary->id]) }}" title="Go back">Modifier</a>
							@else
								<a class="btn btn-primary" href="{{ route('voitures.interventions.summaries.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Go back">Ajouter</a>
							@endif
						</div>
					</div>

				</div>
				<!-- ============================================================== -->
				<!-- FIN RESUME  -->
				<!-- ============================================================== -->



			</div>
		</div>
	</div>
</div>
<!-- ============================================================== -->
<!-- FIN TAB INTERVENTION  -->
<!-- ============================================================== -->



<div class="row">
    <a class="btn btn-secondary mt-3" href="{{ route('voitures.show',['voiture' => $voiture->id]) }}" title="Go back"><i class="fas fa-angle-left"></i>  Retour</a>
</div>

<script>
	$('#exampleModalCenter').modal('show');
</script>

@endsection

