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
        Schema::dropIfExists('guest_rsvp_on_behalf_of');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('guest_rsvp_on_behalf_of', function (Blueprint $table) {
            $table->foreignId('guest_id')->constrained('guests')->cascadeOnDelete();
            $table->foreignId('rsvp_on_behalf_of_id')->constrained('guests')->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
