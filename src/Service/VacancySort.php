<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Vacancy;

class VacancySort
{
    private $sortParam = null;

    private $availableParams = [
        'salary',
        'seniorityLevel',
    ];

    public function __construct(?string $sortBy)
    {
        $this->sortParam = in_array($sortBy, $this->availableParams) ? $sortBy : null;
    }

    /**
     * @param Vacancy[] $list
     * @return Vacancy[]
     */
    public function sort(array $list): array
    {
        if (null === $this->sortParam) {
            return $list;
        }

        usort($list, function (Vacancy $obj1, Vacancy $obj2) {
            return $obj1->toArray()[$this->sortParam] > $obj2->toArray()[$this->sortParam];
        });

        return $list;
    }
}
