<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();

            // Company ownership
            $table->foreignId('company_id')
                ->constrained()
                ->restrictOnDelete();

            // Manufacturing references
            $table->foreignId('factory_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('production_line_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('machine_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Inspection identification
            $table->string('inspection_number');
            $table->string('inspection_type');

            // Inspection information
            $table->dateTime('inspection_date');
            $table->foreignId('inspector_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Inspection outcome
            $table->string('status')->default('scheduled');
            $table->string('result')->nullable();

            // Findings and observations
            $table->text('findings')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes and constraints
            $table->unique(['company_id', 'inspection_number']);
            $table->index(['company_id', 'status']);
            $table->index(['factory_id', 'inspection_date']);
            $table->index(['machine_id', 'inspection_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
