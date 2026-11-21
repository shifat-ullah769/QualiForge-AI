<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->restrictOnDelete();

            $table->foreignId('production_line_id')
                ->constrained('production_lines')
                ->restrictOnDelete();

            $table->string('name');
            $table->string('machine_code');

            $table->string('machine_type')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model_number')->nullable();
            $table->string('serial_number')->nullable();

            $table->date('installation_date')->nullable();

            $table->string('status')->default('active');

            $table->text('description')->nullable();

            $table->timestamps();

            $table->unique(['company_id', 'machine_code']);
            $table->index(['company_id', 'status']);
            $table->index('production_line_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
