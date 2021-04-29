<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableApprovisionnementProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvisionnement_produit', function (Blueprint $table) {
            $table->id();
            $table->integer('quantite');
            $table->integer('prix_achat');
            $table->unsignedBigInteger('approvisionnement_id');
            $table->unsignedBigInteger('produit_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approvisionnement_produit');
    }
}
