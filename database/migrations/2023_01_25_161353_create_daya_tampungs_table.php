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
        Schema::create('daya_tampungs', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama_universitas');
            $table->string('jenjang');
            $table->string('bidang');
            $table->integer('tahun');
            $table->integer('peminat');
            $table->integer('daya_tampung');
            $table->string('peluang');
            $table->string('keketatan');
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
        Schema::dropIfExists('daya_tampungs');
    }
};
