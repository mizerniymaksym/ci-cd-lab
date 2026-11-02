<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\ExportableInterface;
use App\Traits\JsonExportTrait;

class Route extends AbstractEntity implements ExportableInterface
{
    use JsonExportTrait;

    public function __construct(
        int $id,
        string $createdAt,
        private string $mode,
        private float $distanceKm,
        private int $durationMin
    ) {
        parent::__construct($id, $createdAt);
    }

    public function getDetails(): string
    {
        return sprintf(
            'Маршрут #%d: режим %s, %.1f км, %d хв (створено %s)',
            $this->id,
            $this->mode,
            $this->distanceKm,
            $this->durationMin,
            $this->createdAt
        );
    }
}
