Feature: Vacancy end-point

  Scenario: Check that end-point returning vacancy by id is correct
    When I am on "/vacancy/10"
    Then the response status code should be 200
    And vacancy response should contain id equals 10
    And vacancy response should contain job_title equals "Senior Fullstack Developer"

