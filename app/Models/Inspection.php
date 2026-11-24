<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inspection extends Model
{
    protected $fillable = [
        'company_id',
        'factory_id',
        'production_line_id',
        'machine_id',
        'inspection_number',
        'inspection_type',
        'inspection_date',
        'inspector_id',
        'status',
        'result',
        'findings',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'inspection_date' => 'datetime',
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

    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }

    public function defects(): HasMany
    {
        return $this->hasMany(Defect::class);
    }
}
