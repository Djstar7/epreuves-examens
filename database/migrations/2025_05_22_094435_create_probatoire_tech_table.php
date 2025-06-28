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
        Schema::create('probatoire_tech', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id_probatoire_tech');
            $table->string('subject_probatoire_tech');
            $table->year('year_probatoire_tech');
            $table->string('branch_probatoire_tech');
            $table->decimal('price_probatoire_tech', 8, 2);
            $table->string('file_probatoire_tech');
            $table->timestamps();

            $table->foreign('teacher_id_probatoire_tech')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('probatoire_tech');
    }
};
