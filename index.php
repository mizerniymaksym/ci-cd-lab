<?php

declare(strict_types=1);

use Faker\Factory;

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/app/Services/EntityService.php';
require_once __DIR__.'/app/Services/DataProcessor.php';

$distanceKm = 4.7;
$averageSpeedKmh = 40.0;
$durationMin = calculateDurationMin($distanceKm, $averageSpeedKmh);

$faker = Factory::create();

$routeDistances = [];
for ($i = 0; $i < 10; $i++) {
    $routeDistances[] = $faker->randomFloat(1, 0.5, 50);
}

$minDistanceKm = 10.0;

$longRoutes = array_filter($routeDistances, function (float $distance) use ($minDistanceKm): bool {
    return $distance > $minDistanceKm;
});

$subscriptionPrice = 1000.0;
$discount = 150.0;
$discountMessages = [];

try {
    $finalPrice = applyDiscount($subscriptionPrice, $discount);
    $discountMessages[] = "Ціна зі знижкою: {$finalPrice} грн";
} catch (Exception $e) {
    $discountMessages[] = 'Помилка: '.$e->getMessage();
} finally {
    $discountMessages[] = 'Завершення спроби розрахунку.';
}

$inputNumber = 1234076;
$minDigit = findMinDigit($inputNumber);

$routeDescription = 'Маршрут від Львова до Києва проходить через Житомир';
$searchCity = 'Житомир';
$cityPosition = findSubstring($routeDescription, $searchCity);

$navigationHint = 'Поверніть праворуч через двісті метрів';
$evenWordsCount = countEvenLengthWords($navigationHint);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>GPS Navigator - Lab 3</title>
</head>
<body>
    <h2>Завдання 2. Розрахунок тривалості маршруту</h2>
    <p>
        Відстань: <?= $distanceKm ?> км,
        середня швидкість: <?= $averageSpeedKmh ?> км/год →
        тривалість: <strong><?= $durationMin ?> хв</strong>
    </p>

    <h2>Завдання 3. Фільтрація маршрутів (Faker + closure)</h2>
    <p>Згенеровані відстані маршрутів (км): <?= implode(', ', $routeDistances) ?></p>
    <p>Поріг: більше ніж <?= $minDistanceKm ?> км</p>
    <p>Довгі маршрути: <strong><?= implode(', ', $longRoutes) ?></strong></p>

    <h2>Завдання 4. Обробка винятків</h2>
    <p>Ціна підписки: <?= $subscriptionPrice ?> грн, знижка: <?= $discount ?>%</p>
    <ul>
        <?php foreach ($discountMessages as $message) { ?>
            <li><?= htmlspecialchars($message) ?></li>
        <?php } ?>
    </ul>

    <h2>Завдання 5. Алгоритмічні задачі (варіант 4)</h2>

    <h3>3.2 №7. Мінімальна цифра числа</h3>
    <p>Число: <?= $inputNumber ?> → мінімальна цифра: <strong><?= $minDigit ?></strong></p>

    <h3>3.3 №1. Пошук підрядка</h3>
    <p>Рядок: «<?= htmlspecialchars($routeDescription) ?>»</p>
    <p>Шуканий підрядок: «<?= htmlspecialchars($searchCity) ?>»</p>
    <p>
        <?php if ($cityPosition !== null) { ?>
            Знайдено: <strong>«<?= htmlspecialchars($searchCity) ?>»</strong> на позиції <?= $cityPosition ?>
        <?php } else { ?>
            Підрядок не знайдено
        <?php } ?>
    </p>

    <h3>3.4 №5. Слова з парною кількістю символів</h3>
    <p>Рядок: «<?= htmlspecialchars($navigationHint) ?>»</p>
    <p>Кількість слів з парною довжиною: <strong><?= $evenWordsCount ?></strong></p>
</body>
</html>