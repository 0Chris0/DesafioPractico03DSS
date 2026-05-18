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
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); //Clave primaria de el requisito de base de datos y migraciones
            $table->string('nombre', 150);
            $table->string('talla', 10); 
            $table->string('color', 50)->nullable();
            $table->decimal('precio', 8, 2); 
            $table->integer('stock'); 
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade'); //Clave foranea y restriccion de el requisito de base de datos y migraciones
            $table->foreignId('proveedor_id')->constrained('proveedores')->onDelete('cascade'); //Clave foranea y restriccion de el requisito de base de datos y migraciones
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
        Schema::dropIfExists('productos');
    }
};
