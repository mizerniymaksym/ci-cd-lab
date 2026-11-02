<?php

declare(strict_types=1);

namespace App\Core;

use LogicException;

final class Database
{
    private static ?Database $instance = null;

    private function __construct() {}

    private function __clone() {}

    public function __wakeup(): void
    {
        throw new LogicException('Неможливо десеріалізувати Singleton.');
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self;
            echo 'Підключення до БД створено'.PHP_EOL;
        }

        return self::$instance;
    }
}
