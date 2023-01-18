<?php

declare(strict_types=1);

namespace App\Repository;

use App\DTO\Vacancy;
use App\Factory\VacancyFactory;
use App\Helper\CsvLoader;

class VacancyRepository implements VacancyRepositoryInterface
{
    private const DATA_FILE = '/www/vacancies.csv';

    /**
     * @var Vacancy[]
     */
    private $vacancies;

    public function __construct()
    {
        $this->loadData();
    }

    private function loadData(): void
    {
        $csvList = CsvLoader::loadToAssocArray(self::DATA_FILE);
        foreach ($csvList as $csvRow) {
            $vacancy = VacancyFactory::createFromArray($csvRow);
            $this->vacancies[$vacancy->getId()] = $vacancy;
        }
    }

    public function find(int $id): ?Vacancy
    {
        return $this->vacancies[$id] ?? null;
    }

    public function getAll(): array
    {
        return $this->vacancies;
    }
}
