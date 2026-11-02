<?php

declare(strict_types=1);

require_once __DIR__.'/vendor/autoload.php';

use App\Core\Database;
use App\Core\EntityFactory;
use App\Services\ConsoleLogger;
use App\Services\EntityService;
use App\Services\FileLogger;
use App\Tasks\Book;
use App\Tasks\Category;
use App\Tasks\HeadOfDepartment;
use App\Tasks\Student;
use App\Tasks\Teacher;
use App\Tasks\Triangle;

if (PHP_SAPI !== 'cli') {
    header('Content-Type: text/html; charset=utf-8');
    echo '<pre>';
}

function section(string $title): void
{
    echo PHP_EOL.'=== '.$title.' ==='.PHP_EOL;
}

section('Singleton: Database');
$db1 = Database::getInstance();
$db2 = Database::getInstance();
echo 'Той самий екземпляр: '.($db1 === $db2 ? 'так' : 'ні').PHP_EOL;

section('Factory: створення сутностей');
$route = EntityFactory::createEntity('route', [
    'id' => 1,
    'createdAt' => '2026-10-28 10:00:00',
    'mode' => 'driving',
    'distanceKm' => 4.7,
    'durationMin' => 15,
]);
$place = EntityFactory::createEntity('place', [
    'id' => 2,
    'createdAt' => '2026-10-28 10:05:00',
    'name' => 'Площа Ринок',
    'latitude' => 49.8419,
    'longitude' => 24.0315,
]);
echo $route->getDetails().PHP_EOL;
echo $place->getDetails().PHP_EOL;

try {
    EntityFactory::createEntity('car', []);
} catch (InvalidArgumentException $e) {
    echo 'Помилка фабрики: '.$e->getMessage().PHP_EOL;
}

section('Trait: експорт Route у JSON');
echo $route->exportToJson().PHP_EOL;

section('Dependency Injection: EntityService + ConsoleLogger');
$service = new EntityService(new ConsoleLogger);
$service->register($route);
$service->register($place);
$service->export($route);

section('Dependency Injection: EntityService + FileLogger');
$fileService = new EntityService(new FileLogger);
$fileService->register($place);

section('Варіант 4. Табл. 4.2 №3: Book та Category');
$category = new Category(1, 'Програмування');
$category->addBook(new Book(1, 'Clean Code', ['Robert C. Martin'], 2008));
$category->addBook(new Book(2, 'Design Patterns', ['Erich Gamma', 'Richard Helm', 'Ralph Johnson', 'John Vlissides'], 1994));
$category->addBook(new Book(3, 'Clean Architecture', ['Robert C. Martin'], 2017));
echo "Категорія «{$category->getName()}», книг: ".count($category->getBooks()).PHP_EOL;
echo 'Пошук «clean»:'.PHP_EOL;
foreach ($category->searchBook('clean') as $book) {
    echo '  '.$book->getInfo().PHP_EOL;
}
echo 'Видалення книги #2: '.($category->removeBook(2) ? 'успішно' : 'не знайдено').PHP_EOL;
echo 'Видалення книги #99: '.($category->removeBook(99) ? 'успішно' : 'не знайдено').PHP_EOL;
echo 'Книги після видалення:'.PHP_EOL;
foreach ($category->getBooks() as $book) {
    echo '  '.$book->getInfo().PHP_EOL;
}

section('Варіант 4. Табл. 4.3 №2: Персона -> Студент -> Викладач -> Завідувач кафедри');
$people = [
    new Student('Максим', 'Мізерний', 2005, 'КН-42'),
    new Teacher('Олена', 'Коваль', 1985, 'КН-42', 'Веб-програмування'),
    new HeadOfDepartment('Ігор', 'Петренко', 1970, 'КН-42', 'Бази даних', 'Комп\'ютерних наук'),
];
foreach ($people as $person) {
    echo $person::class.': '.$person->getRoleDetails().PHP_EOL;
}

section('Варіант 4. Табл. 4.4 №2: Triangle (формула Герона)');
$triangle = new Triangle(3, 4, 5);
echo "Сторони: {$triangle->a}, {$triangle->b}, {$triangle->c}".PHP_EOL;
echo 'Периметр: '.$triangle->getPerimeter().PHP_EOL;
echo 'Площа: '.round($triangle->getArea(), 2).PHP_EOL;

try {
    new Triangle(1, 2, 10);
} catch (InvalidArgumentException $e) {
    echo 'Помилка: '.$e->getMessage().PHP_EOL;
}

try {
    $triangle->a = 10;
} catch (Error $e) {
    echo 'Спроба змінити readonly-сторону: '.$e->getMessage().PHP_EOL;
}
if (PHP_SAPI !== 'cli') {
    echo '</pre>';
}
