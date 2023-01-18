<?php

namespace App\Repository;

use App\DTO\Vacancy;

interface VacancyRepositoryInterface
{
    public function find(int $id): ?Vacancy;

    public function getAll(): array;
}
