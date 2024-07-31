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
       Schema::create('fan_klub', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('id_fan');
    $table->unsignedBigInteger('id_klub');
    $table->foreign('id_klub')->references('id')->on('klubs')->onDelete('cascade');
    $table->foreign('id_fan')->references('id')->on('fans')->onDelete('cascade');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fan_klubs');
    }
};
