<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductionLine extends Model
{
    protected $fillable = [
        'company_id',
        'factory_id',
        'name',
        'code',
        'description',
        'location',
        'status',
        'created_by',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function factory(): BelongsTo
    {
        return $this->belongsTo(Factory::class);
    }

    public function machines(): HasMany
    {
        return $this->hasMany(Machine::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(UserAssignment::class);
    }
}
