<?php

namespace App\Repository\Eloquent;

use App\Models\Pharmacies;
use App\Repository\Eloquent\EloquentRepository;

/**
 * Description of PharmaciesRepository
 */
class PharmaciesRepository extends EloquentRepository
{
    public function getModelName(): string
    {
        return Pharmacies::class;
    }
}
