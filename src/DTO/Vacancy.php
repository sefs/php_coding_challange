<?php

declare(strict_types=1);

namespace App\DTO;

class Vacancy implements \JsonSerializable
{
    private $id;

    private $jobTitle;

    private $seniorityLevel;

    private $countryCode;

    private $city;

    private $salary;

    private $currency;

    private $requiredSkills;

    private $companySize;

    private $companyDomain;

    public function __construct(
        string $id,
        string $jobTitle,
        string $seniorityLevel,
        string $countryCode,
        string $city,
        string $salary,
        string $currency,
        string $requiredSkills,
        string $companySize,
        string $companyDomain
    ) {
        $this->id = intval($id);
        $this->jobTitle = $jobTitle;
        $this->seniorityLevel = $seniorityLevel;
        $this->countryCode = $countryCode;
        $this->city = $city;
        $this->salary = intval($salary);
        $this->currency = $currency;
        $this->requiredSkills = explode(', ', $requiredSkills);
        $this->companySize = $companySize;
        $this->companyDomain = $companyDomain;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getJobTitle(): string
    {
        return $this->jobTitle;
    }

    public function getSeniorityLevel(): string
    {
        return $this->seniorityLevel;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getSalary(): int
    {
        return $this->salary;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getRequiredSkills(): array
    {
        return $this->requiredSkills;
    }

    public function getCompanySize(): string
    {
        return $this->companySize;
    }

    public function getCompanyDomain(): string
    {
        return $this->companyDomain;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
