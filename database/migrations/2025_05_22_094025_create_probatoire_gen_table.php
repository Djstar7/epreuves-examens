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
        Schema::create('probatoire_gen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id_probatoire_gen');
            $table->string('subject_probatoire_gen');
            $table->year('year_probatoire_gen');
            $table->string('serie_probatoire_gen');
            $table->decimal('price_probatoire_gen', 8, 2);
            $table->string('file_probatoire_gen');
            $table->timestamps();

            $table->foreign('teacher_id_probatoire_gen')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('probatoire_gen');
    }
};
