<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Vacancy;
use App\Helper\Str;

class VacancyLocationFilter implements VacancyFilterInterface
{
    /**
     * @var string
     */
    private $location;

    public function __construct(string $location)
    {
        $this->location = $location;
    }

    /**
     * @param Vacancy[] $vacancies
     * @return Vacancy[]
     */
    public function filter(array $vacancies): array
    {
        if (empty($this->location)) {
            return $vacancies;
        }

        return array_filter($vacancies, function (Vacancy $vacancy) {
            return Str::same($this->location, $vacancy->getCity()) || Str::same($this->location, $vacancy->getCountryCode());
        });
    }
}
