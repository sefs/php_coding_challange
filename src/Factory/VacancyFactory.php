<?php

declare(strict_types=1);

namespace App\Factory;

use App\DTO\Vacancy;

class VacancyFactory
{
    public static function createFromArray(array $data): Vacancy
    {
        return new Vacancy(
            $data['id'],
            $data['job_title'],
            $data['seniority_level'],
            $data['country'],
            $data['city'],
            $data['salary'],
            $data['currency'],
            $data['required_skills'],
            $data['company_size'],
            $data['company_domain']
        );
    }
}
