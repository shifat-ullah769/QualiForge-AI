<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();

            // Company and uploader
            $table->foreignId('company_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('uploaded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Optional manufacturing location
            $table->foreignId('factory_id')
                ->nullable()
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('production_line_id')
                ->nullable()
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('machine_id')
                ->nullable()
                ->constrained()
                ->restrictOnDelete();

            // Dataset information
            $table->string('name');
            $table->string('original_filename');
            $table->string('stored_path');
            $table->string('disk')->default('local');

            $table->string('file_extension', 20);
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('file_size_bytes');

            // Processing and validation
            $table->string('status')->default('uploaded');
            $table->string('validation_status')->default('pending');

            $table->unsignedBigInteger('row_count')->nullable();
            $table->unsignedInteger('column_count')->nullable();

            $table->json('validation_errors')->nullable();
            $table->timestamp('validated_at')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['company_id', 'status']);
            $table->index(['company_id', 'validation_status']);
            $table->index(['factory_id', 'production_line_id']);
            $table->index('machine_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('datasets');
    }
};
