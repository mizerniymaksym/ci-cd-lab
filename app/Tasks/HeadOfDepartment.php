<?php

declare(strict_types=1);

namespace App\Tasks;

class HeadOfDepartment extends Teacher
{
    public function __construct(
        string $name,
        string $surname,
        int $birthYear,
        string $group,
        string $subject,
        protected string $department
    ) {
        parent::__construct($name, $surname, $birthYear, $group, $subject);
    }

    public function getRoleDetails(): string
    {
        return parent::getRoleDetails().", завідувач кафедри «{$this->department}»";
    }
}
