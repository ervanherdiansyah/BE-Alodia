<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_alamat', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable()->index();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->string('alamat_lengkap');
            $table->foreignId('provinsi_id');
            $table->foreign('provinsi_id')->references('id')->on('provinces');
            $table->foreignId('kota_id');
            $table->foreign('kota_id')->references('id')->on('cities');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('kode_pos');
            $table->boolean('alamat_utama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_alamat');
    }
};
