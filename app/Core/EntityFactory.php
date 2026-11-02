<?php

declare(strict_types=1);

namespace App\Core;

use App\Models\AbstractEntity;
use App\Models\Place;
use App\Models\Route;
use InvalidArgumentException;

class EntityFactory
{
    public static function createEntity(string $type, array $data): AbstractEntity
    {
        return match ($type) {
            'route' => new Route(
                $data['id'],
                $data['createdAt'],
                $data['mode'],
                $data['distanceKm'],
                $data['durationMin']
            ),
            'place' => new Place(
                $data['id'],
                $data['createdAt'],
                $data['name'],
                $data['latitude'],
                $data['longitude']
            ),
            default => throw new InvalidArgumentException("Невідомий тип сутності: {$type}"),
        };
    }
}
