<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('dataset_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('requested_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('status')->default('queued');

            $table->string('model_version')->nullable();

            $table->json('result_payload')->nullable();

            $table->json('summary')->nullable();

            $table->json('error_details')->nullable();

            $table->timestamp('started_at')->nullable();

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->index(['company_id', 'status']);
            $table->index(['dataset_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
