<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Vacancy;
use App\DTO\VacancyQueryFilter;
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
        foreach ($vacancyQueryFilter->getFilters() as $filterObj) {
            $vacancies = $filterObj->filter($vacancies);
        }

        return $vacancySort->sort($vacancies);
    }

    /**
     * @param VacancyQueryFilter $vacancyQueryFilter
     * @param VacancySort $vacancySort
     * @return Vacancy|null
     */
    public function findOneByFilter(VacancyQueryFilter $vacancyQueryFilter, VacancySort $vacancySort): ?Vacancy
    {
        $vacancies = $this->findByFilter($vacancyQueryFilter, $vacancySort);

        // We sort in ascending order so last row will be the best one
        return empty($vacancies) ? null : end($vacancies);

    }


}
