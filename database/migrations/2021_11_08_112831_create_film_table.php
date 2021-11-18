<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_gat');
            $table->foreign('id_gat')
            ->references('id')
            ->on('gatunek')
            ->onDelete('no action');
            $table->unsignedBigInteger('id_rezyser');
            $table->foreign('id_rezyser')
            ->references('id')
            ->on('gwiazda')
            ->onDelete('no action');
            $table->string('tytul');
            $table->date('data_premiery');
            $table->text('opis');
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
        Schema::dropIfExists('film');
    }
}
