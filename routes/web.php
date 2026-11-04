<?php

use App\Http\Controllers\PlaceController;
use App\Http\Controllers\TrafficReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/health', fn () => response()->json([
    'status' => 'OK',
    'timestamp' => now(),
]))->name('health');

Route::get('/about', fn () => response()->json([
    'system' => 'RouteWise — GPS-навігатор',
    'version' => '0.5.0',
]))->name('about');

Route::prefix('places')->name('places.')->group(function () {
    Route::get('/', [PlaceController::class, 'index'])->name('index');

    Route::post('/', [PlaceController::class, 'store'])
        ->middleware('place.admin')
        ->name('store');

    Route::get('/{id}', [PlaceController::class, 'show'])
        ->whereNumber('id')
        ->name('show');
});

Route::get('/traffic-reports', [TrafficReportController::class, 'index'])
    ->name('traffic-reports.index');
