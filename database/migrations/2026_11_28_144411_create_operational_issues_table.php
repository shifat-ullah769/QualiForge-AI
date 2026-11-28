<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operational_issues', function (Blueprint $table) {
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
            $table->string('issue_type');
            $table->string('severity')->default('medium');
            $table->text('description');

            $table->string('status')->default('reported');

            $table->foreignId('reported_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamps();

            $table->index(
                ['company_id', 'status'],
                'operational_issues_company_status_idx'
            );

            $table->index(
                ['reported_by', 'created_at'],
                'operational_issues_reporter_created_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operational_issues');
    }
};
