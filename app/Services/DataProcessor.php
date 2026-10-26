<?php

declare(strict_types=1);

function findMinDigit(int $number): int
{
    if ($number < 1) {
        throw new InvalidArgumentException('Число має бути натуральним (більшим за 0)!');
    }

    $digits = array_map('intval', str_split((string) $number));

    return min($digits);
}

function findSubstring(string $text, string $substring): ?int
{
    $position = mb_strpos($text, $substring);

    return $position === false ? null : $position;
}

function countEvenLengthWords(string $text): int
{
    $words = array_filter(explode(' ', trim($text)), fn (string $word): bool => $word !== '');

    $evenWords = array_filter($words, fn (string $word): bool => mb_strlen($word) % 2 === 0);

    return count($evenWords);
}
