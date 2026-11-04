<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    private array $places = [
        [
            'id' => 1,
            'category_id' => 1,
            'name' => 'Ратуша',
            'address' => 'пл. Ринок, 1, Івано-Франківськ',
            'latitude' => 48.9226,
            'longitude' => 24.7111,
            'is_verified' => true,
        ],
        [
            'id' => 2,
            'category_id' => 2,
            'name' => 'Карпатський національний університет',
            'address' => 'вул. Шевченка, 57, Івано-Франківськ',
            'latitude' => 48.9155,
            'longitude' => 24.7095,
            'is_verified' => true,
        ],
        [
            'id' => 3,
            'category_id' => 3,
            'name' => 'Залізничний вокзал',
            'address' => 'пл. Привокзальна, 1, Івано-Франківськ',
            'latitude' => 48.9147,
            'longitude' => 24.7175,
            'is_verified' => false,
        ],
    ];

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->places,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'category_id' => ['required', 'integer', 'min:1'],
        ]);

        $newPlace = [
            'id' => count($this->places) + 1,
            'category_id' => (int) $validated['category_id'],
            'name' => $validated['name'],
            'address' => $validated['address'],
            'latitude' => (float) $validated['latitude'],
            'longitude' => (float) $validated['longitude'],
            'is_verified' => false,
        ];

        $this->places[] = $newPlace;

        return response()->json([
            'status' => 'created',
            'data' => $newPlace,
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $placeId = (int) $id;

        foreach ($this->places as $place) {
            if ($place['id'] === $placeId) {
                return response()->json([
                    'status' => 'success',
                    'data' => $place,
                ], 200);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Місце із зазначеним ідентифікатором не знайдено.',
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
