<?php

declare(strict_types=1);

namespace App\Models;

class Place extends AbstractEntity
{
    public function __construct(
        int $id,
        string $createdAt,
        private string $name,
        private float $latitude,
        private float $longitude
    ) {
        parent::__construct($id, $createdAt);
    }

    public function getDetails(): string
    {
        return sprintf(
            'Місце #%d: %s (%.4f, %.4f), створено %s',
            $this->id,
            $this->name,
            $this->latitude,
            $this->longitude,
            $this->createdAt
        );
    }
}
