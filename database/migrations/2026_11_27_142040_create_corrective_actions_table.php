<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('corrective_actions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->restrictOnDelete();

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

            $table->string('title');
            $table->text('instruction');

            $table->string('priority')->default('medium');
            $table->date('due_date')->nullable();
            $table->string('status')->default('pending');

            $table->foreignId('recorded_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamps();

            $table->index(['company_id', 'status']);
            $table->index(['company_id', 'priority']);
            $table->index(['factory_id', 'production_line_id']);
            $table->index(['machine_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('corrective_actions');
    }
};
