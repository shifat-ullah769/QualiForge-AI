<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prediction extends Model
{
    protected $fillable = [
        'company_id',
        'dataset_id',
        'requested_by',
        'status',
        'model_version',
        'result_payload',
        'summary',
        'error_details',
        'started_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'result_payload' => 'array',
            'summary' => 'array',
            'error_details' => 'array',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function dataset(): BelongsTo
    {
        return $this->belongsTo(Dataset::class);
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
