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
            $table->unsignedBigInteger('gatunek_id');
            $table->foreign('gatunek_id')
            ->references('id')
            ->on('gatunek')
            ->onDelete('no action');
            $table->unsignedBigInteger('gwiazda_id');
            $table->foreign('gwiazda_id')
            ->references('id')
            ->on('gwiazda')
            ->onDelete('no action');
            $table->string('tytul');
            $table->date('data_premiery');
            $table->text('opis');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')
            ->references('id')
            ->on('users')
            ->onDelete('no action');
            $table->boolean('czyokladka');
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
