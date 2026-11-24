<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dataset extends Model
{
    protected $fillable = [
        'company_id',
        'uploaded_by',
        'factory_id',
        'production_line_id',
        'machine_id',
        'name',
        'original_filename',
        'stored_path',
        'disk',
        'file_extension',
        'mime_type',
        'file_size_bytes',
        'status',
        'validation_status',
        'row_count',
        'column_count',
        'validation_errors',
        'validated_at',
    ];

    protected function casts(): array
    {
        return [
            'file_size_bytes' => 'integer',
            'row_count' => 'integer',
            'column_count' => 'integer',
            'validation_errors' => 'array',
            'validated_at' => 'datetime',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function factory(): BelongsTo
    {
        return $this->belongsTo(Factory::class);
    }

    public function productionLine(): BelongsTo
    {
        return $this->belongsTo(ProductionLine::class);
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

    public function predictions(): HasMany
    {
        return $this->hasMany(Prediction::class);
    }
}
