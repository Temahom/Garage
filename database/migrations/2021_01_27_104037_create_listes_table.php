<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listes', function (Blueprint $table) {
            $table->id();
            $table->string('marques');
            $table->string('lemodel');
            $table->string('lannee');
            $table->string('lecarburant');
            $table->string('lapuissance');
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
        Schema::dropIfExists('listes');
    }
}
