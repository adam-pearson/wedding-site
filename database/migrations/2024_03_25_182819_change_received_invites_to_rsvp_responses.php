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
        Schema::create('rsvp_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->boolean('coming');
            $table->boolean('alcohol');
            $table->string('dietary_requirements')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::dropIfExists('received_invites');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsvp_responses');

        Schema::create('received_invites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->boolean('coming');
            $table->boolean('alcohol');
            $table->string('dietary_requirements')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
