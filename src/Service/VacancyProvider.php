<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Vacancy;
use App\DTO\VacancyQueryFilter;
use App\DTO\VacancySort;
use App\Helper\Str;
use App\Repository\VacancyRepositoryInterface;

class VacancyProvider
{
    /**
     * @var VacancyRepositoryInterface
     */
    private $vacancyRepository;

    public function __construct(VacancyRepositoryInterface $vacancyRepository)
    {
        $this->vacancyRepository = $vacancyRepository;
    }

    /**
     * @param int $id
     * @return Vacancy|null
     */
    public function findById(int $id): ?Vacancy
    {
        return $this->vacancyRepository->find($id);
    }

    /**
     * @param VacancyQueryFilter $vacancyQueryFilter
     * @param VacancySort $vacancySort
     * @return Vacancy[]
     */
    public function findByFilter(VacancyQueryFilter $vacancyQueryFilter, VacancySort $vacancySort): array
    {
        $vacancies = $this->vacancyRepository->getAll();
        $location = $vacancyQueryFilter->getLocation();
        if (null !== $location) {
            $vacancies = array_filter($vacancies, function (Vacancy $vacancy) use ($location) {
                return Str::same($location, $vacancy->getCity()) || Str::same($location, $vacancy->getCountryCode());
            });
        }

        return $vacancySort->sort($vacancies);
    }
}
