<?php

namespace App\Behat;

use App\Helper\Str;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends AbstractFeatureContext
{
    /**
     * @param string $sum
     *
     * @Then /Sum should be equals (?P<sum>\d+)/
     */
    public function thenSumShouldBeEquals($sum)
    {
        $json = $this->getJsonResponse();

        Assert::assertEquals($sum, $json['sum']);
    }

    /**
     * @Then vacancy response should contain :name equals :value
     */
    public function vacancyResponseShouldContainEquals($name, $value)
    {
        $json = $this->getJsonResponse();

        Assert::assertEquals($value, $json[$name]);
    }

    /**
     * @Then the response should contain list of vacancies
     */
    public function theResponseShouldContainListOfVacancies()
    {
        $json = $this->getJsonResponse();
        Assert::assertTrue(count($json) > 0);

        $vacancy = array_shift($json);
        Assert::assertArrayHasKey('id', $vacancy);
        Assert::assertArrayHasKey('jobTitle', $vacancy);
        Assert::assertArrayHasKey('seniorityLevel', $vacancy);
        Assert::assertArrayHasKey('city', $vacancy);
        Assert::assertArrayHasKey('salary', $vacancy);
    }

    /**
     * @Then the results are sorted by :param
     */
    public function theResultsAreSortedBySalary($param)
    {
        $list = $this->getJsonResponse();
        Assert::assertTrue(count($list) > 0);

        $previous = null;
        foreach ($list as $vacancy) {
            if (!$previous) {
                $previous = $vacancy;
                continue;
            }
            Assert::assertTrue($previous[$param] <= $vacancy[$param]);
        }
    }

    /**
     * @Then the results are filtered by location :location
     */
    public function theResultsAreFilteredByLocation($location)
    {
        $list = $this->getJsonResponse();
        Assert::assertTrue(count($list) > 0);

        $previous = null;
        foreach ($list as $vacancy) {
            Assert::assertTrue(
                Str::same($vacancy['countryCode'], $location) || Str::same($vacancy['city'], $location)
            );
        }
    }

    /**
     * @Then vacancy response should contain offer details
     */
    public function vacancyResponseShouldContainOfferDetails()
    {
        $json = $this->getJsonResponse();
        Assert::assertArrayHasKey('id', $json);
        Assert::assertArrayHasKey('jobTitle', $json);
        Assert::assertArrayHasKey('seniorityLevel', $json);
        Assert::assertArrayHasKey('city', $json);
        Assert::assertArrayHasKey('salary', $json);
    }
}
