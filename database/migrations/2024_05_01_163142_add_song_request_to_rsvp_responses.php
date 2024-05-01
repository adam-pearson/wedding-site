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
        Schema::table('rsvp_responses', function (Blueprint $table) {
            $table->string('song_request')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rsvp_responses', function (Blueprint $table) {
            $table->dropColumn('song_request');
        });
    }
};
