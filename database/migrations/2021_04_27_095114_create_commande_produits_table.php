<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_produits', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2021_04_27_095114_create_commande_produits_table.php
            $table->unsignedBigInteger('commande_id');
            $table->unsignedBigInteger('produit_id');
            $table->integer('quantite');
=======
            $table->foreignId('valide_par')->nullable(); 
            $table->foreignId('passer_par')->nullable(); 
            $table->foreignId('devi_id')->nullable(); 
            $table->integer('etat');
>>>>>>> cc0895effdf2df2593f8eb2812c23c60663072cd:database/migrations/2021_02_03_110155_create_commandes_table.php
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
        Schema::dropIfExists('commande_produits');
    }
}
