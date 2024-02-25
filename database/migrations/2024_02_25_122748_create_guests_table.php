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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->enum('guest_type', ['all_day', 'evening']);
            $table->unsignedBigInteger('plus_one_of')->nullable();
            $table->foreign('plus_one_of')
                ->references('id')
                ->on('guests')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->boolean('plus_one_allowed');
            $table->string('unique_code')->index('code')->unique();
            $table->dateTime('invite_sent_at')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
