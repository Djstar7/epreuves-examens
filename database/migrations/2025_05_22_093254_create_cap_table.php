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
        Schema::create('cap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id_cap');
            $table->string('subject_cap');
            $table->year('year_cap');
            $table->string('branch_cap');
            $table->decimal('price_cap', 8, 2);
            $table->string('file_cap');
            $table->timestamps();

            $table->foreign('teacher_id_cap')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cap');
    }
};
