<?php

namespace App\Repository\Eloquent;

use App\Models\Images;
use App\Repository\Eloquent\EloquentRepository;

/**
 * Description of ImagesRepository
 */
class ImagesRepository extends EloquentRepository
{
    public function getModelName(): string
    {
        return Images::class;
    }
}
