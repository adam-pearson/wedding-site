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
            $table->renameColumn('song_request', 'song_requests');
            $table->string('hated_songs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rsvp_responses', function (Blueprint $table) {
            $table->renameColumn('song_requests', 'song_request');
            $table->dropColumn('hated_songs');
        });
    }
};
