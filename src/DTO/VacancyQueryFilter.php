<?php

declare(strict_types=1);

namespace App\DTO;

class VacancyQueryFilter
{
    private $location;

    public function __construct(array $params)
    {
        $this->location = $params['location'] ?? null;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
