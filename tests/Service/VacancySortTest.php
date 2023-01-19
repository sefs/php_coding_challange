<?php

namespace Tests\App\Service;

use App\DTO\Vacancy;
use App\Service\VacancySort;
use PHPUnit\Framework\TestCase;

class VacancySortTest extends TestCase
{
    public function testSortBySalary(): void
    {
        $vacancy1 = new Vacancy(
            '1',
            'jobTitle',
            'seniorityLevel',
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
            'seniorityLevel',
            'countryCode',
            'city',
            '100',
            'PLN',
            'requiredSkills',
            '123',
            'companyDomain'
        );

        $vacancySort = new VacancySort('salary');
        $vacancies = $vacancySort->sort([$vacancy1, $vacancy2]);

        self::assertCount(2, $vacancies);
        self::assertSame($vacancy2->getId(), $vacancies[0]->getId());

        $vacancies = $vacancySort->sort([$vacancy2, $vacancy1]);
        self::assertSame($vacancy2->getId(), $vacancies[0]->getId());
    }

    public function testSortBySeniorityLevel(): void
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

        $vacancySort = new VacancySort('seniorityLevel');
        $vacancies = $vacancySort->sort([$vacancy1, $vacancy2, $vacancy3]);

        self::assertCount(3, $vacancies);
        self::assertSame('Junior', $vacancies[0]->getSeniorityLevel());
        self::assertSame('Middle', $vacancies[1]->getSeniorityLevel());
        self::assertSame('Senior', $vacancies[2]->getSeniorityLevel());
    }

}
