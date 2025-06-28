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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id_orders');
            $table->unsignedBigInteger('bepc_id_orders')->nullable();
            $table->unsignedBigInteger('cap_id_orders')->nullable();
            $table->unsignedBigInteger('probatoire_gen_id_orders')->nullable();
            $table->unsignedBigInteger('probatoire_tech_id_orders')->nullable();
            $table->unsignedBigInteger('bac_gen_id_orders')->nullable();
            $table->unsignedBigInteger('bac_tech_id_orders')->nullable();
            $table->unsignedBigInteger('concours_id_orders')->nullable();
            $table->unsignedBigInteger('bts_id_orders')->nullable();
            $table->string('exam_name_orders');
            $table->decimal('amount_orders', 8, 2);
            $table->enum('status_orders', ['En-cours', 'Payer', 'Annuler']);
            $table->string('payment_method_orders')->nullable();
            $table->string('transaction_id_orders')->nullable();
            $table->string('billing_address_orders')->nullable();
            $table->timestamps();
            
            $table->foreign('student_id_orders')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('bepc_id_orders')->references('id')->on('bepc')->onDelete('cascade');
            $table->foreign('cap_id_orders')->references('id')->on('cap')->onDelete('cascade');
            $table->foreign('probatoire_gen_id_orders')->references('id')->on('probatoire_gen')->onDelete('cascade');
            $table->foreign('probatoire_tech_id_orders')->references('id')->on('probatoire_tech')->onDelete('cascade');
            $table->foreign('bac_gen_id_orders')->references('id')->on('bac_gen')->onDelete('cascade');
            $table->foreign('bac_tech_id_orders')->references('id')->on('bac_tech')->onDelete('cascade');
            $table->foreign('concours_id_orders')->references('id')->on('concours')->onDelete('cascade');
            $table->foreign('bts_id_orders')->references('id')->on('bts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
