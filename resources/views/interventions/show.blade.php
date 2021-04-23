@extends('layout.index')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />


@include('voitures._partials.carinformation')

<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
<link rel="stylesheet" href="assets/libs/css/style.css">
<link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
<link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
<link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
<link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
<link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
<link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">



<!-- ============================================================== -->
<!-- TAB INTERVENTION  -->
<!-- ============================================================== -->
<div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px;box-shadow: 0 10px 20px rgba(148,149,150,0.19), 0 6px 6px rgba(148,149,150,0.23); ">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
		<div class="section-block">
			<h2 class="section-title py-4" style="text-align: center; text-shadow: 1px 1px 3px #b3b9ee">INTERVENTION</h2>
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
								<h4><u>Constat:</u></h4>
								<p>{{ $diagnostic->constat }}</p>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col-md-12">
								<table class="table table-bordered mb-4">
									<tbody>
										<tr>
											<th scope="col" colspan="4">Coût du Diagnostic</th>
											<th scope="col" style="width: 200px">{{ number_format($diagnostic->coût, 0, ",", " " ) }} F CFA</th>
										</tr>
									</tbody>
								</table>

								<table class="table table-bordered">
									<thead style="background-color: #4656E9;">
									<tr>
										<th scope="col" style="color: #ffffff">Code</th>
										<th scope="col" style="color: #ffffff">Localisaton</th>
										<th scope="col" style="color: #ffffff">Déscription</th>
										<th scope="col" style="color: #ffffff">Etat</th>
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
                    @can('create', App\Models\Diagnostic::class)
					<div class="row mt-4">
						<div class="col-md-12">
							@if ( $intervention->diagnostic_id )
								<a class="btn btn-warning" href="{{ route('voitures.interventions.diagnostics.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Modifier">Modifier</a>
									@if (isset($intervention->facture_id) && $intervention->facture_id)
									<a class="btn btn-primary" href="/facture/diagnostic/{{$facture->id}}" title="Imprimer Facture">Imprimer la facture</a>
									<a class="btn btn-primary" href="/send-facture/{{$facture->id}}" title="Envoyer la facture">Envoyer la facture au client</a>
										@if ($facture->etat==1)
										<a class="btn btn-primary" href="/facture/{{$facture->id}}/payer" title="Payer la facture">Payer la facture</a>
										@endif
									@else
									{{-- Generer la facture de l'intervention --}}
									<a class="btn btn-primary" href="/facture/{{$intervention->id}}" title="Facture">Generer la facture</a>
									@endif
								
							@else
								<a class="btn btn-primary" href="{{ route('voitures.interventions.diagnostics.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Ajouter">Ajouter</a>
							@endif
						</div>
					</div>
					@endcan
					

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

									<table class="table table-bordered">
										<thead style="background-color: #4656E9;">
											<tr>
												<th scope="col" style="color: #ffffff">Produit</th>
												<th scope="col" style="color: #ffffff">Quantité</th>
												<th scope="col" style="color: #ffffff">Prix unitaire (F CFA)</th>
												<th scope="col" style="color: #ffffff; width: 200px">Montant (F CFA)</th>
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
										</tbody>
									</table>

									<table class="table table-bordered mt-5">
										<tbody>
											<tr>
												<th scope="col" colspan="4">Total produit(s) commandé(s)</th>
												<th scope="col">{{ number_format($total, 0, ",", " ") }}</th>
											</tr>
											<tr>
												<th scope="col" colspan="4">Coût du Diagnostic</th>
												@if (isset($diagnostic->coût))
													<th scope="col" style="width: 200px">{{ number_format($diagnostic->coût, 0, ",", " " ) }}</th>
												@else
													<th scope="col" style="width: 200px">0</th>
												@endif
											</tr>
											<tr>
												<th scope="col" colspan="4">Cout de réparation</th>
												<th scope="col" style="width: 200px">{{ number_format($devi->cout, 0, ",", " " ) }}</th>
											</tr>
										</tbody>
									</table>

									<table class="table table-bordered mt-4">
										<tbody>
											<tr>
												<th scope="col" colspan="4">Net à payer</th>
												@if (isset($diagnostic->coût))
													<th scope="col" style="width: 200px"><?php echo number_format($total + $devi->cout + $diagnostic->coût, 0, ",", " ") ?></th>
												@else
													<th scope="col" style="width: 200px"><?php echo number_format($total + $devi->cout, 0, ",", " ") ?></th>
												@endif
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
						
						
						@can('create', App\Models\Devi::class)
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
						@endcan
					

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
					@can('create', App\Models\Summary::class)
					<div class="row mt-4">
						<div class="col-md-12">
							@if ( $intervention->summary_id )
								
								<a class="btn btn-warning" href="{{ route('voitures.interventions.summaries.edit',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'summary' => $summary->id]) }}" title="Go back">Modifier</a>
							@else
								<a class="btn btn-primary" href="{{ route('voitures.interventions.summaries.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Go back">Ajouter</a>
							@endif
						</div>
					</div>
					@endcan

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
<script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="/assets/libs/js/main-js.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
{{-- Le notifiaction des devis  --}}
@if(Session::has('devis-send'))
<script>
	toastr.success("{!! Session::get('devis-send') !!}")
	swal("Envoie Devis !", "{!! Session::get('devis-send') !!}", "success");
</script>
@endif

@if(Session::has('payer_facture'))
<script>
	toastr.success("{!! Session::get('payer_facture') !!}")
	swal("Paiement Fatcure!", "{!! Session::get('payer_facture') !!}", "success");
</script>
@endif

@if(Session::has('creer_facture'))
<script>
	swal("Création Fatcure!", "{!! Session::get('creer_facture') !!}", "success");
</script>
@endif
@if(Session::has('facture-send'))
<script>
	toastr.success("{!! Session::get('facture-send') !!}")
	swal("Envoie Fatcure!", "{!! Session::get('facture-send') !!}", "success");
</script>
@endif
@endsection

