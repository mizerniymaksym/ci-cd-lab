<?php

declare(strict_types=1);

namespace App\Tasks;

class Teacher extends Student
{
    public function __construct(
        string $name,
        string $surname,
        int $birthYear,
        string $group,
        protected string $subject
    ) {
        parent::__construct($name, $surname, $birthYear, $group);
    }

    public function getRoleDetails(): string
    {
        return parent::getRoleDetails().", викладає дисципліну «{$this->subject}»";
    }
}
