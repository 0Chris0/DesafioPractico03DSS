<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id(); //Clave primaria de el requisito de base de datos y migraciones
            $table->string('nombre', 150);
            $table->string('telefono', 20)->nullable();
            $table->string('contacto_asesor', 100)->nullable();
            $table->timestamps(); //timestamps de el requisito de base de datos y migraciones
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedors');
    }
};
