<?php

use App\Models\Role;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Role::class)->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('profile_pic')->default('assets/images/profile_pic.png');
            $table->enum('user_type', ['SUPER_ADMIN', 'ADMIN', 'USER'])->default('USER');
            $table->enum('status', ['ACTIVE', 'BANNED'])->default('ACTIVE');
            $table->index(['name', 'phone', 'email']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
