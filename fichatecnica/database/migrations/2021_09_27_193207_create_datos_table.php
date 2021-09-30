<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos', function (Blueprint $table) {
            $table->id();
            $table->String("nombre");
            $table->String("cargo");
            $table->String("unidad");
            $table->String("codigo");
            $table->String("modelo");
            $table->String("procesador")->nullable();
            $table->String("memoriaram")->nullable();
            $table->String("capacidadram")->nullable();
            $table->String("discoduro")->nullable();
            $table->String("capacidaddd")->nullable();
            $table->String("tarjetavideo")->nullable();
            $table->String("tarjetared")->nullable();
            $table->String("tipomantenimiento");
            $table->String("observaciones")->nullable();
            $table->datetime("fechaingreso")->nullable();
            $table->datetime("fechasalida")->nullable();
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
        Schema::dropIfExists('datos');
    }
}
