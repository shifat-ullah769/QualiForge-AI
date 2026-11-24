<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('defects', function (Blueprint $table) {
            $table->foreignId('inspection_id')
                ->nullable()
                ->after('machine_id')
                ->constrained('inspections')
                ->nullOnDelete();

            $table->index(['company_id', 'inspection_id']);
        });
    }

    public function down(): void
    {
        Schema::table('defects', function (Blueprint $table) {
            $table->dropIndex(['company_id', 'inspection_id']);
            $table->dropConstrainedForeignId('inspection_id');
        });
    }
};
