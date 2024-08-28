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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->string('transaction_code');
            $table->string('transaction_invoiceno')->nullable();
            $table->string('transaction_method')->nullable();
            $table->decimal('transaction_amount', 10, 2);
            $table->string('transaction_status');
            $table->string('transaction_refno')->nullable();
            $table->timestamp('transaction_issued_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
