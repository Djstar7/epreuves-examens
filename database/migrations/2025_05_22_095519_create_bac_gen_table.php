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
        Schema::create('bac_gen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id_bac_gen');
            $table->string('subject_bac_gen');
            $table->year('year_bac_gen');
            $table->string('serie_bac_gen');
            $table->decimal('price_bac_gen', 8, 2);
            $table->string('file_bac_gen');
            $table->timestamps();

            $table->foreign('teacher_id_bac_gen')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bac_gen');
    }
};
