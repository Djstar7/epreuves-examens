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
        Schema::Create('concours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id_concours');
            $table->string('subject_concours');
            $table->year('year_concours');
            $table->string('school_concours');
            $table->string('cycle_concours');
            $table->string('speciality_concours')->nullable();
            $table->decimal('price_concours', 8, 2);
            $table->string('file_concours');
            $table->timestamps();
            
            $table->foreign('teacher_id_concours')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concours');
    }
};
