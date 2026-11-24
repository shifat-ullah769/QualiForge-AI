
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('defects', function (Blueprint $table) {
            $table->id();

            // Company ownership
            $table->foreignId('company_id')
                ->constrained()
                ->restrictOnDelete();

            // Optional manufacturing references
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

            // Defect identification
            $table->string('batch_number')->nullable();
            $table->string('product_code')->nullable();
            $table->string('defect_type');
            $table->string('severity')->default('medium');

            // Defect quantity and description
            $table->unsignedInteger('defect_quantity')->default(1);
            $table->text('description')->nullable();

            // Defect tracking
            $table->string('status')->default('open');
            $table->text('resolution_notes')->nullable();

            // Reporting information
            $table->foreignId('reported_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('detected_at')->nullable();
            $table->timestamp('resolved_at')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['company_id', 'status']);
            $table->index(['company_id', 'severity']);
            $table->index(['factory_id', 'production_line_id']);
            $table->index(['machine_id', 'detected_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('defects');
    }
};