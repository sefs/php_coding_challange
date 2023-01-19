<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Vacancy;

class VacancySkillFilter implements VacancyFilterInterface
{
    /**
     * @var array
     */
    private $skills;

    /**
     * @var int
     */
    private $requiredSkillsNumber;

    public function __construct(array $skills)
    {
        $this->skills = $skills;
        $this->requiredSkillsNumber = $this->requiredSkillsNumber($skills);
    }

    /**
     * @param Vacancy[] $vacancies
     * @return Vacancy[]
     */
    public function filter(array $vacancies): array
    {
        if (empty($this->skills)) {
            return $vacancies;
        }

        return array_filter($vacancies, function (Vacancy $vacancy) {
            $vacancySkills = array_map('strtolower', $vacancy->getRequiredSkills());
            $userSkills = array_map('strtolower', $this->skills);

            return count(array_intersect($vacancySkills, $userSkills)) >= $this->requiredSkillsNumber;
        });
    }

    /**
     * @param array $skills
     * @return int
     */
    private function requiredSkillsNumber(array $skills): int
    {
        switch (count($skills)) {
            case 0;
                return 0;
            case 1:
            case 2:
            case 3:
                return 1;
            case 4:
            case 5:
                return 2;
            default:
                return 3;
        }
    }
}
