Feature: Vacancy end-point

  Scenario: Check that end-point returning vacancy by id is correct
    When I am on "/vacancy/10"
    Then the response status code should be 200
    And vacancy response should contain id equals 10
    And vacancy response should contain jobTitle equals "Senior Fullstack Developer"

  Scenario: Check that end-point returning vacancy list
    When I am on "/vacancy/search"
    Then the response status code should be 200
    And the response should contain list of vacancies

  Scenario: Check that end-point returning vacancy list in order
    When I am on "/vacancy/search?sort=salary"
    Then the response status code should be 200
    And the response should contain list of vacancies
    And the results are sorted by salary

  Scenario: Check that end-point returning vacancy list in order
    When I am on "/vacancy/search?sort=seniorityLevel"
    Then the response status code should be 200
    And the response should contain list of vacancies
    And the results are sorted by seniorityLevel

  Scenario: Check that end-point returning vacancy list filter results by location
    When I am on "/vacancy/search?location=DE"
    Then the response status code should be 200
    And the response should contain list of vacancies
    And the results are filtered by location "DE"

  Scenario: Check that end-point returning vacancy list filter results by location
    When I am on "/vacancy/search?location=Amsterdam"
    Then the response status code should be 200
    And the response should contain list of vacancies
    And the results are filtered by location "Amsterdam"
