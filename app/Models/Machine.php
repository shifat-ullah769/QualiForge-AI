<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Machine extends Model
{
    protected $fillable = [
        'company_id',
        'production_line_id',
        'name',
        'machine_code',
        'machine_type',
        'manufacturer',
        'model_number',
        'serial_number',
        'installation_date',
        'status',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'installation_date' => 'date',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function productionLine(): BelongsTo
    {
        return $this->belongsTo(ProductionLine::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(UserAssignment::class);
    }
}
