<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('production_lines', function (Blueprint $table) {
            $table->foreignId('factory_id')
                ->nullable()
                ->after('company_id')
                ->constrained('factories')
                ->restrictOnDelete();

            $table->index(['factory_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('production_lines', function (Blueprint $table) {
            $table->dropIndex(['factory_id', 'status']);
            $table->dropConstrainedForeignId('factory_id');
        });
    }
};
