<?php

declare(strict_types=1);

namespace App\Tasks;

abstract class Person
{
    public function __construct(
        protected string $name,
        protected string $surname,
        protected int $birthYear
    ) {}

    public function getFullName(): string
    {
        return "{$this->name} {$this->surname}";
    }

    abstract public function getRoleDetails(): string;
}
