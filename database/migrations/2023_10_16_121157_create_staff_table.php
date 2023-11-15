<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
			$table->string('first_name')->nullable();
			$table->string('middle_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('phone_number')->nullable();
			$table->string('address')->nullable();
			$table->string('email');
			$table->string('dept');
			$table->string('designation');
			$table->string('emergency_contact')->nullable();
			$table->string('emargency_addr')->nullable();
			$table->integer('emergency_phone')->nullable();
			// $table->string('unique_id');
			$table->string('profile_pic')->nullable();
			$table->string('signature')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
