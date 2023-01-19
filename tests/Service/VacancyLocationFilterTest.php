<?php

namespace Tests\App\Service;

use App\DTO\Vacancy;
use App\Service\VacancyLocationFilter;
use PHPUnit\Framework\TestCase;

class VacancyLocationFilterTest extends TestCase
{
    public function testLocationFilterByCountryCode(): void
    {
        $vacancy1 = new Vacancy(
            '1',
            'jobTitle',
            'seniorityLevel',
            'PL',
            'Szczecin',
            '200',
            'PLN',
            'requiredSkills',
            '123',
            'companyDomain'
        );
        $vacancy2 = new Vacancy(
            '2',
            'jobTitle',
            'seniorityLevel',
            'DE',
            'Berlin',
            '100',
            'EUR',
            'requiredSkills',
            '123',
            'companyDomain'
        );

        $locationFilter = new VacancyLocationFilter('PL');
        $vacancies = $locationFilter->filter([$vacancy1, $vacancy2]);

        self::assertCount(1, $vacancies);
        self::assertSame('PL', array_shift($vacancies)->getCountryCode());
    }

    public function testLocationFilterByCity(): void
    {
        $vacancy1 = new Vacancy(
            '1',
            'jobTitle',
            'seniorityLevel',
            'PL',
            'Szczecin',
            '200',
            'PLN',
            'requiredSkills',
            '123',
            'companyDomain'
        );
        $vacancy2 = new Vacancy(
            '2',
            'jobTitle',
            'seniorityLevel',
            'DE',
            'Berlin',
            '100',
            'EUR',
            'requiredSkills',
            '123',
            'companyDomain'
        );

        $locationFilter = new VacancyLocationFilter('berlin');
        $vacancies = $locationFilter->filter([$vacancy1, $vacancy2]);

        self::assertCount(1, $vacancies);
        self::assertSame('Berlin', array_shift($vacancies)->getCity());
    }
}
