<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroCostosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_costos', function (Blueprint $table) {
            $table->id();
            $table->string('costoName');
            $table->float('monto', 15, 2);
            $table->enum('type', ['MD', 'MOD','CIF','Periodo']);
            $table->unsignedBigInteger('LCostos_id');
            $table->foreign('LCostos_id')
                    ->references('id')->on('lista_costos')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('registro_costos');
    }
}
