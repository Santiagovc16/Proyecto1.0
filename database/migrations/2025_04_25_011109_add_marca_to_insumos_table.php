<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarcaToInsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('insumos', function (Blueprint $table) {
        $table->string('marca')->nullable();
    });
}

public function down()
{
    Schema::table('insumos', function (Blueprint $table) {
        $table->dropColumn('marca');
    });
}
}
