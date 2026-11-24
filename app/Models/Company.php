<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Company extends Model
{
    protected $fillable = [
        'name',
        'code',
        'industry',
        'contact_email',
        'contact_phone',
        'address',
        'city',
        'country',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function factories(): HasMany
    {
        return $this->hasMany(Factory::class);
    }

    public function productionLines(): HasMany
    {
        return $this->hasMany(ProductionLine::class);
    }

    public function machines(): HasManyThrough
    {
        return $this->hasManyThrough(
            Machine::class,
            ProductionLine::class
        );
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(UserAssignment::class);
    }

    public function predictions(): HasMany
    {
        return $this->hasMany(Prediction::class);
    }

    public function defects(): HasMany
    {
        return $this->hasMany(Defect::class);
    }
}
