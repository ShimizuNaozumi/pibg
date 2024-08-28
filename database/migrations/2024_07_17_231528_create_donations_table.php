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
        Schema::create('donations', function (Blueprint $table) {
            $table->id('donation_id');
            $table->string('donor_name');
            $table->string('donor_email');
            $table->string('donor_notel');
            $table->unsignedBigInteger('fund_id');
            $table->foreign('fund_id')->references('fund_id')->on('funds');
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('transaction_id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
