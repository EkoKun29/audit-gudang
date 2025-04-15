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
        Schema::table('audit_checkers', function (Blueprint $table) {
            // Tambahkan foreign key dari id_audit ke audits(id)
            $table->foreign('id_audit')
                  ->references('id')
                  ->on('audits')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audit_checkers', function (Blueprint $table) {
            $table->dropForeign(['id_audit']);
        });
    }
};
