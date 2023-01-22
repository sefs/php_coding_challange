# Auto1 Coding Challenge

## API Structure

### GET /vacancy/:id

Required parameter:
- *int* `id` - ID of the vacancy

End-point will return 200 and JSON data with vacancy properties 
or 404 and empty response when vacancy is not found.

```
GET http://localhost:8001/vacancy/1

RESPONSE:
{
    "id": 1,
    "jobTitle": "Senior PHP Developer",
    "seniorityLevel": "Senior",
    "countryCode": "DE",
    "city": "Berlin",
    "salary": 747500,
    "currency": "SVU",
    "requiredSkills": [
        "PHP",
        "Symfony",
        "REST",
        "Unit-testing",
        "Behat",
        "SOLID",
        "Docker",
        "AWS"
    ],
    "companySize": "100-500",
    "companyDomain": "Automotive"
}
```


### GET /vacancy/search

Optional parameters:
 - `location` - will filter results by country code or city
 - `sort` - will order results ascending by `salary` or `seniorityLevel`

I.e.
```
GET http://localhost:8001/vacancy/search?sort=salary&location=DE

RESPONSE:
[
    {
        "id": 3,
        "jobTitle": "Junior PHP Developer",
        "seniorityLevel": "Junior",
        "countryCode": "DE",
        "city": "Berlin",
        "salary": 517500,
        "currency": "SVU",
        "requiredSkills": [
            "PHP",
            "LAMP",
            "HTML",
            "CSS",
            "SQL"
        ],
        "companySize": "100-500",
        "companyDomain": "Automotive"
    },
    {
        "id": 9,
        "jobTitle": "Middle JavaScript developer",
        "seniorityLevel": "Middle",
        "countryCode": "DE",
        "city": "Berlin",
        "salary": 621000,
        "currency": "SVU",
        "requiredSkills": [
            "JavaScript",
            "TypeScript",
            "SASS",
            "React"
        ],
        "companySize": "10-50",
        "companyDomain": "Logistics"
    },
    ...
]
```

```
http://localhost:8001/vacancy/search?sort=seniorityLevel&location=ES

RESPONSE:
[
    {
        "id": 11,
        "jobTitle": "Middle Fullstack Developer",
        "seniorityLevel": "Middle",
        "countryCode": "ES",
        "city": "Barcelona",
        "salary": 598000,
        "currency": "SVU",
        "requiredSkills": [
            "Node.js",
            "JavaScript",
            "CSS/SASS",
            "Angular"
        ],
        "companySize": "1000-5000",
        "companyDomain": "Mining"
    },
    {
        "id": 10,
        "jobTitle": "Senior Fullstack Developer",
        "seniorityLevel": "Senior",
        "countryCode": "ES",
        "city": "Barcelona",
        "salary": 506000,
        "currency": "SVU",
        "requiredSkills": [
            "Node.js",
            "JavaScript",
            "CSS/SASS",
            "PHPUnit",
            "Karma",
            "Jenkins"
        ],
        "companySize": "1000-5000",
        "companyDomain": "Mining"
    },
    ...
]
```

### GET /vacancy/best

This end-point will look for the best vacancy based on passed arguments, but it will prioritize higher salary.
See `VacancySkillFilter` to check logic behind skill comparision.

Optional parameters:
- `seniorityLevel` - will filter vancies by seniority level. Result will contain vacancy with expected or lower level. 
I.e. for `middle` it can return vacancies with `junior` or `middle` level.
- (*array*) `skills` - will filter results by skills. Remember to pass this argument as array. I.e. `skills[]=PHP`.

I.e.
```
http://localhost:8001/vacancy/best?seniorityLevel=senior&skills[]=symfony&skills[]=php&skills[]=docker&skills[]=SOLID

RESPONSE:
{
    "id": 26,
    "jobTitle": "Middle Fullstack Developer",
    "seniorityLevel": "Middle",
    "countryCode": "IE",
    "city": "Dublin",
    "salary": 862500,
    "currency": "SVU",
    "requiredSkills": [
        "PHP",
        "JavaScript",
        "CSS/SASS",
        "SQL",
        "AWS",
        "Docker"
    ],
    "companySize": "10-50",
    "companyDomain": "Logistics"
}
```

### Testing

To run tests use following command (if you use Docker)
```
docker-compose run php composer install        # to install dependencies
docker-compose up                              # to run your app
docker-compose run php /www/vendor/bin/phpunit # to run unit tests
docker-compose run php /www/vendor/bin/behat   # to run behat tests
```

Or if you don't use docker:
```
composer install                      # to install dependencies
bin/console server:run 127.0.0.1:8001 # to run your app
./vendor/bin/phpunit                  # to run unit tests
./vendor/bin/behat                    # to run behat tests
```

To generate PHPUnit coverage:
```
docker-compose run php /www/vendor/bin/phpunit --coverage-html var/coverage
```
