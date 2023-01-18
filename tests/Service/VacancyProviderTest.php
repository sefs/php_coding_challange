<?php

namespace Tests\App\Service;

use App\DTO\Vacancy;
use App\DTO\VacancyQueryFilter;
use App\DTO\VacancySort;
use App\Factory\VacancyFactory;
use App\Repository\VacancyRepositoryInterface;
use App\Service\VacancyProvider;
use PHPUnit\Framework\TestCase;

class VacancyProviderTest extends TestCase
{
    public function testFindById(): void
    {
        $vacancy = new Vacancy(
            '1',
            'jobTitle',
            'seniorityLevel',
            'countryCode',
            'city',
            '1234',
            'PLN',
            'requiredSkills',
            '123',
            'companyDomain'
        );

        $vacancyRepositoryMock = $this->createMock(VacancyRepositoryInterface::class);
        $vacancyRepositoryMock
            ->expects($this->exactly(2))
            ->method('find')
            ->with(1)
            ->willReturn($vacancy);

        $vacancyProvider = new VacancyProvider($vacancyRepositoryMock);

        self::assertInstanceOf(Vacancy::class, $vacancyProvider->findById(1));
        self::assertSame($vacancy, $vacancyProvider->findById(1));
    }

    public function testFindByIdWillReturnNull(): void
    {
        $vacancyRepositoryMock = $this->createMock(VacancyRepositoryInterface::class);
        $vacancyRepositoryMock
            ->expects($this->once())
            ->method('find')
            ->willReturn(null);

        $vacancyProvider = new VacancyProvider($vacancyRepositoryMock);

        self::assertNull($vacancyProvider->findById(123));
    }

    public function testFindByFilter(): void
    {
        $limit = 10;
        $testData = $this->getVacancyList($limit);
        $vacancyRepositoryMock = $this->createMock(VacancyRepositoryInterface::class);
        $vacancyRepositoryMock
            ->expects($this->once())
            ->method('getAll')
            ->willReturn(
                $testData
            );

        $vacancyProvider = new VacancyProvider($vacancyRepositoryMock);
        $filter = new VacancyQueryFilter([]);
        $sort = new VacancySort(null);
        $vacancies = $vacancyProvider->findByFilter($filter, $sort);

        self::assertCount($limit, $vacancies);
        self::assertSame($testData, $vacancies);
    }

    public function testFindByFilterWithSort(): void
    {
        $limit = 10;
        $testData = $this->getVacancyList($limit);
        $vacancyRepositoryMock = $this->createMock(VacancyRepositoryInterface::class);
        $vacancyRepositoryMock
            ->expects($this->once())
            ->method('getAll')
            ->willReturn(
                $testData
            );

        $vacancyProvider = new VacancyProvider($vacancyRepositoryMock);
        $filter = new VacancyQueryFilter([]);
        $sort = new VacancySort('seniorityLevel');
        $vacancies = $vacancyProvider->findByFilter($filter, $sort);

        self::assertCount($limit, $vacancies);
        self::assertNotSame($testData, $vacancies);

        // sort test data by the same key
        usort($testData, function (Vacancy $obj1, $obj2) {
            return $obj1->getSeniorityLevel() > $obj2->getSeniorityLevel();
        });

        self::assertSame($testData, $vacancies);
    }

    public function testFindByFilterWithLocation(): void
    {
        $limit = 10;
        $testData = $this->getVacancyList($limit);
        $vacancyRepositoryMock = $this->createMock(VacancyRepositoryInterface::class);
        $vacancyRepositoryMock
            ->expects($this->once())
            ->method('getAll')
            ->willReturn(
                $testData
            );

        $vacancyProvider = new VacancyProvider($vacancyRepositoryMock);
        $filter = new VacancyQueryFilter(['location' => 'Szczecin']);
        $sort = new VacancySort(null);
        $vacancies = $vacancyProvider->findByFilter($filter, $sort);

        self::assertCount(4, $vacancies);
        self::assertNotSame($testData, $vacancies);

        foreach ($vacancies as $vacancy) {
            self::assertSame('Szczecin', $vacancy->getCity());
        }
    }

    public function testFindByFilterWithCountry(): void
    {
        $limit = 10;
        $testData = $this->getVacancyList($limit);
        $vacancyRepositoryMock = $this->createMock(VacancyRepositoryInterface::class);
        $vacancyRepositoryMock
            ->expects($this->once())
            ->method('getAll')
            ->willReturn(
                $testData
            );

        $vacancyProvider = new VacancyProvider($vacancyRepositoryMock);
        $filter = new VacancyQueryFilter(['location' => 'DE']);
        $sort = new VacancySort(null);
        $vacancies = $vacancyProvider->findByFilter($filter, $sort);

        self::assertCount(3, $vacancies);
        self::assertNotSame($testData, $vacancies);

        foreach ($vacancies as $vacancy) {
            self::assertSame('DE', $vacancy->getCountryCode());
        }
    }

    private function getVacancyList(int $limit): array
    {
        $vacancies = [];
        for ($i = 0; $i < $limit; $i++) {
            switch ($i % 3) {
                case 0:
                    $seniorityLevel = 'Junior';
                    $countryCode = 'PL';
                    $city = 'Szczecin';
                    break;
                case 1:
                    $seniorityLevel = 'Middle';
                    $countryCode = 'DE';
                    $city = 'Berlin';
                    break;
                case 2:
                default:
                    $seniorityLevel = 'Senior';
                    $countryCode = 'NL';
                    $city = 'Amsterdam';
                    break;
            }
            $data = [
                'id' => strval($i),
                'job_title' => $seniorityLevel . ' PHP Developer',
                'seniority_level' => $seniorityLevel,
                'country' => $countryCode,
                'city' => $city,
                'salary' => strval($i * 1000),
                'currency' => 'SVU',
                'required_skills' => 'PHP, Symfony, REST',
                'company_size' => '123',
                'company_domain' => 'Automotive'
            ];
            $vacancies[] = VacancyFactory::createFromArray($data);
        }

        return $vacancies;
    }
}
