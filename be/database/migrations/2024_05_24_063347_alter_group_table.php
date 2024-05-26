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
        Schema::table('group', function (Blueprint $table) {
            $table->foreignId('leader_id')->constrained(
                table: 'user', indexName: 'group_leader_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group', function (Blueprint $table) {
            $table->dropForeign(['leader_id']);
            $table->dropColumn(['leader_id']);
        });
    }
};
