<?php

declare(strict_types=1);

namespace App\DTO;

use App\Service\VacancyFilterInterface;
use App\Service\VacancyLocationFilter;
use App\Service\VacancySeniorityLevelFilter;
use App\Service\VacancySkillFilter;

class VacancyQueryFilter
{
    /**
     * @var VacancyFilterInterface[]
     */
    private $filters = [];

    public function __construct(array $params)
    {
        $this->filters[] = new VacancyLocationFilter($params['location'] ?? '');
        $this->filters[] = new VacancySkillFilter($params['skills'] ?? []);
        $this->filters[] = new VacancySeniorityLevelFilter($params['seniorityLevel'] ?? '');

    }

    /**
     * @return VacancyFilterInterface[]
     */
    public function getFilters(): array
    {
        return $this->filters;
    }
}
