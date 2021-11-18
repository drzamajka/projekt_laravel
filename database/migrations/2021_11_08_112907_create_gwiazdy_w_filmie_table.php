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
        Schema::create('gwiazdy_w_filmie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_filmu');
            $table->foreign('id_filmu')
            ->references('id')
            ->on('film')
            ->onDelete('no action');
            $table->unsignedBigInteger('id_gwiazdy');
            $table->foreign('id_gwiazdy')
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
        Schema::dropIfExists('gwiazdy_w_filmie');
    }
}
