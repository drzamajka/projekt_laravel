<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGwiazdyWFilmieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_gwiazda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id');
            $table->foreign('film_id')
            ->references('id')
            ->on('film')
            ->onDelete('no action');
            $table->unsignedBigInteger('gwiazda_id');
            $table->foreign('gwiazda_id')
            ->references('id')
            ->on('gwiazda')
            ->onDelete('no action');
            $table->string('rola');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_gwiazda');
    }
}
