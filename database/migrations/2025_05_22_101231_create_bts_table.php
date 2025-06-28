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
        Schema::create('bts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id_bts');
            $table->string('subject_bts');
            $table->year('year_bts');
            $table->string('branch_bts');
            $table->string('speciality_bts');
            $table->decimal('price_bts', 8, 2);
            $table->string('file_bts');
            $table->timestamps();

            $table->foreign('teacher_id_bts')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bts');
    }
};
