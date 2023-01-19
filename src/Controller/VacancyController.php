<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\VacancyQueryFilter;
use App\Service\VacancyProvider;
use App\Service\VacancySort;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class VacancyController
{
    /**
     * @var VacancyProvider
     */
    private $vacancyProvider;
    public function __construct(VacancyProvider $vacancyProvider)
    {
        $this->vacancyProvider = $vacancyProvider;
    }

    public function getAction(int $id): JsonResponse
    {
        $vacancy = $this->vacancyProvider->findById($id);
        if ($vacancy) {
            return new JsonResponse($vacancy);
        }

        return new JsonResponse(null, 404);
    }

    public function searchAction(Request $request): JsonResponse
    {
        $params = $request->query->all();
        $filter = new VacancyQueryFilter([
            'location' => $params['location'] ?? ''
        ]);
        $sort = new VacancySort($params['sort'] ?? null);
        $vacancies = $this->vacancyProvider->findByFilter($filter, $sort);

        return new JsonResponse($vacancies);
    }

    public function getBestAction(Request $request): JsonResponse
    {
        $filter = new VacancyQueryFilter([
            'skills' => $request->query->get('skills', []),
            'seniorityLevel' => $request->query->get('seniorityLevel', 'Junior')
        ]);
        $sort = new VacancySort('salary');
        $vacancy = $this->vacancyProvider->findOneByFilter($filter, $sort);
        if ($vacancy) {
            return new JsonResponse($vacancy);
        }

        return new JsonResponse(null, 404);
    }
}
