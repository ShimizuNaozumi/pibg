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
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('admin_name');
            $table->string('admin_username')->unique();
            $table->string('admin_email')->unique();
            $table->string('admin_notel')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('admin_password');
            $table->enum('admin_status', ['active', 'inactive']);
            $table->enum('admin_category', ['superadmin', 'teacher', 'treasurer']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
