@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('commandes.index') }}" title="Go back"> <i class="fas fa-backward "></i>  Retour</a>
            </div>
        </div>
    </div>
        <br>
    <div class="row">
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
                        @foreach ($devi['item_commandes'] as $item)
                            <tr>
                                <td>{{ $item['produit']->produit }}</td>
                                <td>{{ $item['commande_produit']->quantite }}</td>
                                <td>{{ number_format($item['produit']->prix1, 0, ",", " " ) }}</td>
                                <td><?php echo number_format($item['produit']->prix1 * $item['commande_produit']->quantite, 0, ",", " ") ?></td>
                            </tr>
                            <?php $total += $item['produit']->prix1 * $item['commande_produit']->quantite ?>
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
                      <!--      <th scope="col" style="width: 200px">{{ number_format($diagnostic->coût, 0, ",", " " ) }}</th>   -->
                        </tr>
                        <tr>
                            <th scope="col" colspan="4">Cout de réparation</th>
                                   <!--   <th scope="col" style="width: 200px">{{ number_format($devi->cout, 0, ",", " " ) }}</th>  -->
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered mt-4">
                    <tbody>
                        <tr>
                            <th scope="col" colspan="4">Net à payer</th>
                                 <!--     <th scope="col" style="width: 200px"><?php //echo number_format($total + $devi->cout + $diagnostic->coût, 0, ",", " ") ?></th>  -->
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    
    @can('create', App\Models\Commande::class)
    </div>
@endsection