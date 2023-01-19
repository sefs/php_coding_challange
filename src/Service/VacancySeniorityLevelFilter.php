<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Vacancy;

class VacancySeniorityLevelFilter implements VacancyFilterInterface
{
    /**
     * @var string
     */
    private $seniorityLevel;

    public function __construct(string $seniorityLevel)
    {
        $this->seniorityLevel = $seniorityLevel;
    }

    /**
     * This will return all roles that are equal or lower than expected
     * I.e. "Senior" will return Junior, Middle and Senior roles
     * But "Middle" will return only Junior, Middle
     *
     * @param Vacancy[] $vacancies
     * @return Vacancy[]
     */
    public function filter(array $vacancies): array
    {
        if (empty($this->seniorityLevel)) {
            return $vacancies;
        }

        return array_filter($vacancies, function (Vacancy $vacancy) {
            return strtolower($vacancy->getSeniorityLevel()) <= strtolower($this->seniorityLevel);
        });
    }
}
