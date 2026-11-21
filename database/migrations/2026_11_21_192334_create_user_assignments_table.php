<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->restrictOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('factory_id')
                ->constrained('factories')
                ->restrictOnDelete();

            $table->foreignId('production_line_id')
                ->nullable()
                ->constrained('production_lines')
                ->nullOnDelete();

            $table->foreignId('machine_id')
                ->nullable()
                ->constrained('machines')
                ->nullOnDelete();

            $table->foreignId('assigned_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->date('assigned_at');

            $table->date('ended_at')->nullable();

            $table->string('status')->default('active');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['company_id', 'user_id', 'status']);
            $table->index(['factory_id', 'status']);
            $table->index(['production_line_id', 'status']);
            $table->index(['machine_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_assignments');
    }
};
