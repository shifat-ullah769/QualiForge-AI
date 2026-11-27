<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('corrective_action_evidences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('corrective_action_id')
                ->constrained('corrective_actions')
                ->cascadeOnDelete();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->restrictOnDelete();

            $table->string('original_name');
            $table->string('file_path');
            $table->string('mime_type', 100);
            $table->unsignedBigInteger('file_size');

            $table->foreignId('uploaded_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamps();

            $table->index(
                ['company_id', 'corrective_action_id'],
                'ca_evidence_company_action_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('corrective_action_evidences');
    }
};
