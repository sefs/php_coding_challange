<?php

namespace Tests\App\Service;

use App\DTO\Vacancy;
use App\Helper\Str;
use App\Service\VacancySeniorityLevelFilter;
use PHPUnit\Framework\TestCase;

class VacancySeniorityLevelFilterTest extends TestCase
{
    public function testSeniorityLevelFilter(): void
    {
        $vacancy1 = new Vacancy(
            '1',
            'jobTitle',
            'Senior',
            'countryCode',
            'city',
            '200',
            'PLN',
            'requiredSkills',
            '123',
            'companyDomain'
        );
        $vacancy2 = new Vacancy(
            '2',
            'jobTitle',
            'Junior',
            'countryCode',
            'city',
            '100',
            'PLN',
            'requiredSkills',
            '123',
            'companyDomain'
        );
        $vacancy3 = new Vacancy(
            '3',
            'jobTitle',
            'Middle',
            'countryCode',
            'city',
            '100',
            'PLN',
            'requiredSkills',
            '123',
            'companyDomain'
        );

        $seniorityLevelFilter = new VacancySeniorityLevelFilter('Senior');
        $vacancies = $seniorityLevelFilter->filter([$vacancy1, $vacancy2, $vacancy3]);

        self::assertCount(3, $vacancies);

        $seniorityLevelFilter = new VacancySeniorityLevelFilter('Middle');
        $vacancies = $seniorityLevelFilter->filter([$vacancy1, $vacancy2, $vacancy3]);

        self::assertCount(2, $vacancies);
        foreach ($vacancies as $vacancy) {
            self::assertTrue(Str::same($vacancy->getSeniorityLevel(), 'Junior')
                || Str::same($vacancy->getSeniorityLevel(), 'Middle'));
        }
    }
}
