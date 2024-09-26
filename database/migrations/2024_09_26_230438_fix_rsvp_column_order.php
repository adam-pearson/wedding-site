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
            $table->dropColumn('song_requests');
            $table->dropColumn('hated_songs');
        });

        Schema::table('rsvp_responses', function (Blueprint $table) {
            $table->text('song_requests')->after('dietary_requirements');
            $table->text('hated_songs')->after('song_requests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rsvp_responses', function (Blueprint $table) {
            $table->dropColumn('song_requests');
            $table->dropColumn('hated_songs');
        });

        Schema::table('rsvp_responses', function (Blueprint $table) {
            $table->text('song_requests')->after('deleted_at');
            $table->text('hated_songs')->after('song_requests');
        });
    }
};
