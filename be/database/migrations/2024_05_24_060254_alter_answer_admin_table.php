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
        Schema::table('answer_admin', function (Blueprint $table) {
            $table->foreignId('question_admin_id')->constrained(
                table: 'question_admin', indexName: 'answer_admin_question_admin_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answer_admin', function (Blueprint $table) {
            $table->dropForeign(['question_admin_id']);
            $table->dropColumn(['question_admin_id']);
        });
    }
};
