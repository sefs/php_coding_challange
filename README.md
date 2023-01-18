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
 - location - will filter results by country code or city
 - sort - will order results ascending by `salary` or `seniorityLevel`

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


