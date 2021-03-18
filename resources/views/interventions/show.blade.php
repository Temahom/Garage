@extends('layout.index')

@section('content')
@if($message = Session::get('devis-send'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{$message}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
  </div>
@endif

@include('voitures._partials.carinformation')




<!-- ============================================================== -->
<!-- TAB INTERVENTION  -->
<!-- ============================================================== -->
<div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px;box-shadow: 0 10px 20px rgba(148,149,150,0.19), 0 6px 6px rgba(148,149,150,0.23); ">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
		<div class="section-block">
			<h2 class="section-title py-4" style="text-align: center;">INTERVENTION</h2>
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
						<div class="row">
							<div class="col-md-12">
								<h4>Constat</h4>
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
					@else
						<div class="row">
							<div class="col-md-12">
								<p>Vide...</p>
							</div>
						</div>
					@endif

					<div class="row mt-4">
						<div class="col-md-12">
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

						<div class="row mt-4">
							<div class="col-md-12">
								<p><b>Date d'expiration : </b>{{$devi->date_expiration}}</p>
							</div>
						</div>
						
						<div class="row my-4">
							<div class="col-md-12">

								<table class="table table-bordered mb-4">
									<tbody>
										<tr>
											<th scope="col" colspan="4">Cout de réparation</th>
											<th scope="col" style="width: 200px">{{ number_format($devi->cout, 0, ",", " " ) }}</th>
										</tr>
									</tbody>
								</table>

								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">Produit</th>
											<th scope="col">Quantité</th>
											<th scope="col">Prix/1</th>
											<th scope="col" style="width: 200px">Total</th>
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

								<table class="table table-bordered mt-4">
									<tbody>
										<tr>
											<th scope="col" colspan="4">Net à payer</th>
											<th scope="col" style="width: 200px"><?php echo number_format($total + $devi->cout, 0, ",", " ") ?></th>
										</tr>
									</tbody>
								</table>

							</div>
						</div>
					@else
						<div class="row">
							<div class="col-md-12">
								<p>Vide...</p>
							</div>
						</div>
					@endif

					<div class="row mt-4">
						<div class="col-md-12">
							@if ( $intervention->devis_id )
								<a class="btn btn-warning" href="{{ route('voitures.interventions.devis.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Modifier">Modifier</a>
								<a href="/Pdf/{{$intervention->id}}" target="_blank" class="btn btn-primary"><i class="icon-printer"></i> Imprimer</a>
								<a href="/send-devis/{{$intervention->id}}" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"> Envoyer au client</i></a>	
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
					@if ( $intervention->summary_id )
						<div class="row">
							<div class="col-md-12 py-4">
								<p><?php echo $summary->resume ?></p>
							</div>
						</div>
					@else
						<div class="row">
							<div class="col-md-12">
								<p>Vide...</p>
							</div>
						</div>
					@endif
					<div class="row mt-4">
						<div class="col-md-12">
							@if ( $intervention->summary_id )
								
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

