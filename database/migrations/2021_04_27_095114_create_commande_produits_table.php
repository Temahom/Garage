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
            $table->foreignId('valide_par')->nullable(); 
            $table->foreignId('passer_par')->nullable(); 
            $table->foreignId('devi_id')->nullable(); 
            $table->integer('etat');
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
