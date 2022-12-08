<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuplaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_suplai', function (Blueprint $table) {
            $table->id();
            $table->string('no_trans');
            $table->string('nama_supplier');
            $table->integer('obat_id');
            $table->integer('jumlah');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('obat_id')->references('id')->on('tbl_obat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suplais');
    }
}
