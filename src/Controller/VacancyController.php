<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\VacancyQueryFilter;
use App\DTO\VacancySort;
use App\Service\VacancyProvider;
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
        $filter = new VacancyQueryFilter($params);
        $sort = new VacancySort($params['sort'] ?? null);
        $vacancies = $this->vacancyProvider->findByFilter($filter, $sort);

        return new JsonResponse($vacancies);
    }
}
