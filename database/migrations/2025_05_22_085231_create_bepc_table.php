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
        Schema::create('bepc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id_bepc');
            $table->string('subject_bepc');
            $table->year('year_bepc');
            $table->decimal('price_bepc', 8, 2);
            $table->string('file_bepc');
            $table->timestamps();

            $table->foreign('teacher_id_bepc')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bepc');
    }
};
