<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Defect extends Model
{
    protected $fillable = [
        'company_id',
        'factory_id',
        'production_line_id',
        'machine_id',
        'batch_number',
        'product_code',
        'defect_type',
        'severity',
        'defect_quantity',
        'description',
        'status',
        'resolution_notes',
        'reported_by',
        'detected_at',
        'resolved_at',
        'inspection_id',
    ];

    protected function casts(): array
    {
        return [
            'defect_quantity' => 'integer',
            'detected_at' => 'datetime',
            'resolved_at' => 'datetime',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
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

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function inspection(): BelongsTo
    {
        return $this->belongsTo(Inspection::class);
    }
}
