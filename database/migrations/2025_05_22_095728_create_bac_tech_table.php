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
        Schema::create('bac_tech', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id_bac_tech');
            $table->string('subject_bac_tech');
            $table->year('year_bac_tech');
            $table->string('branch_bac_tech');
            $table->decimal('price_bac_tech', 8, 2);
            $table->string('file_bac_tech');
            $table->timestamps();

            $table->foreign('teacher_id_bac_tech')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bac_tech');
    }
};
