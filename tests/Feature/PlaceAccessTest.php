<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class PlaceAccessTest extends TestCase
{
    private array $payload = [
        'name' => 'Кав\'ярня «Франко»',
        'address' => 'вул. Незалежності, 10, Івано-Франківськ',
        'latitude' => 48.9210,
        'longitude' => 24.7100,
        'category_id' => 2,
    ];

    public function test_request_without_admin_header_is_blocked_by_middleware(): void
    {
        $response = $this->postJson('/places', $this->payload);

        $response->assertStatus(403)
            ->assertJson([
                'status' => 'access_denied',
            ]);
    }

    public function test_request_with_admin_header_passes_middleware(): void
    {
        $response = $this->withHeaders([
            'X-User-Role' => 'admin',
        ])->postJson('/places', $this->payload);

        $response->assertStatus(201);
        $response->assertHeader('X-Security-Policy', 'Enforced');
    }

    public function test_places_list_returns_ok(): void
    {
        $this->getJson('/places')->assertStatus(200);
    }

    public function test_unknown_place_returns_not_found(): void
    {
        $this->getJson('/places/999')->assertStatus(404);
    }
}
