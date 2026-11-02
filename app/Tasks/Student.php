<?php

declare(strict_types=1);

namespace App\Tasks;

class Student extends Person
{
    public function __construct(
        string $name,
        string $surname,
        int $birthYear,
        protected string $group
    ) {
        parent::__construct($name, $surname, $birthYear);
    }

    public function getRoleDetails(): string
    {
        return "{$this->getFullName()} ({$this->birthYear} р.н.), група {$this->group}";
    }
}
