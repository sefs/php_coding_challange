<?php

namespace App\Service;

use App\DTO\Vacancy;

interface VacancyFilterInterface
{
    /**
     * @param Vacancy[] $vacancies
     * @return Vacancy[]
     */
    public function filter(array $vacancies): array;
}
