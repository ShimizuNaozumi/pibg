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
        Schema::create('fees', function (Blueprint $table) {
            $table->id('fee_id');
            $table->unsignedBigInteger('fee_session_id');
            $table->foreign('fee_session_id')->references('fee_session_id')->on('fee_sessions');
            $table->string('fee_name');
            $table->decimal('fee_amount', 8, 2);
            $table->enum('fee_specific', ['family','student','standard1','standard2','standard3','standard4','standard5','standard6','ppki']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
