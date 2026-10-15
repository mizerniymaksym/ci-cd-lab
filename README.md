# CI/CD Lab - PHP Calculator

[![PHP CI Application](https://github.com/mizerniymaksym/ci-cd-lab/actions/workflows/php-ci.yml/badge.svg?branch=main)](https://github.com/mizerniymaksym/ci-cd-lab/actions/workflows/php-ci.yml)

Мінімальний PHP-проєкт для вивчення керування версіями та CI/CD з GitHub Actions.

## Функціонал

- **Calculator** — додавання та віднімання чисел
- **Unit-тести** на PHPUnit
- **Лінтинг** коду за допомогою Laravel Pint
- **Автоматичний CI**: лінтер і тести запускаються на кожен Pull Request та push у `main`
- **Захист гілки** `main`: злиття можливе лише після успішного проходження перевірок

## Запуск тестів локально

Потрібні PHP 8.2+ та Composer.

```bash
composer install
./vendor/bin/pint --test
./vendor/bin/phpunit tests/Unit
```
