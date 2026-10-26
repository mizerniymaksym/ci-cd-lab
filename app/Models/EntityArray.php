<?php

$categories = ['Parking', 'Gas Station', 'Cafe', 'Hotel', 'Hospital'];

sort($categories);

$route = [
    'id' => 1,
    'user_id' => 42,
    'mode' => 'driving',
    'distance_km' => 4.7,
    'duration_min' => 15,
    'geometry' => 'u{~vFvyys@fS]',
    'cache_key' => 'route_49.84_24.03_49.83_24.01_driving',
    'created_at' => '2026-10-26 10:00:00',
];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>GPS Navigator - Arrays</title>
</head>
<body>
    <h2>Категорії місць (відсортовано)</h2>
    <ul>
        <?php foreach ($categories as $category) { ?>
            <li><?= htmlspecialchars($category) ?></li>
        <?php } ?>
    </ul>

    <h2>Маршрут (об'єкт класу Route)</h2>
    <ul>
        <?php foreach ($route as $key => $value) { ?>
            <li>
                <strong><?= htmlspecialchars($key) ?>:</strong>
                <?= htmlspecialchars((string) $value) ?>
            </li>
        <?php } ?>
    </ul>
</body>
</html>