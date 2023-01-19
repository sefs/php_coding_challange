<?php

namespace Tests\App\Service;

use App\DTO\Vacancy;
use App\Service\VacancySkillFilter;
use PHPUnit\Framework\TestCase;

class VacancySkillFilterTest extends TestCase
{
    public function testSkillFilter(): void
    {
        $vacancy1 = new Vacancy(
            '1',
            'jobTitle',
            'seniorityLevel',
            'countryCode',
            'city',
            '200',
            'PLN',
            'PHP, Symfony, Docker',
            '123',
            'companyDomain'
        );
        $vacancy2 = new Vacancy(
            '2',
            'jobTitle',
            'seniorityLevel',
            'countryCode',
            'city',
            '100',
            'PLN',
            'HTML, CSS, JS',
            '123',
            'companyDomain'
        );

        $skillFilter = new VacancySkillFilter(['PHP', 'Symfony']);
        $vacancies = $skillFilter->filter([$vacancy1, $vacancy2]);

        self::assertCount(1, $vacancies);
        self::assertSame(['PHP', 'Symfony', 'Docker'], array_shift($vacancies)->getRequiredSkills());
    }

    public function testSkillFilterReturnEmptyList(): void
    {
        $vacancy1 = new Vacancy(
            '1',
            'jobTitle',
            'seniorityLevel',
            'countryCode',
            'city',
            '200',
            'PLN',
            'PHP, Symfony, Docker',
            '123',
            'companyDomain'
        );
        $vacancy2 = new Vacancy(
            '2',
            'jobTitle',
            'seniorityLevel',
            'countryCode',
            'city',
            '100',
            'PLN',
            'HTML, CSS, JS',
            '123',
            'companyDomain'
        );

        $skillFilter = new VacancySkillFilter(['Java']);
        $vacancies = $skillFilter->filter([$vacancy1, $vacancy2]);

        self::assertCount(0, $vacancies);
    }
}
