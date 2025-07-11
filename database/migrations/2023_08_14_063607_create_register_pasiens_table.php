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
        Schema::create('register_pasiens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pasien_id');
            $table->string('no_register');
            $table->string('poli_id');
            $table->boolean('pay')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pasien_id')->references('id')->on('pasiens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_pasiens');
    }
};
