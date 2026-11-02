<?php

declare(strict_types=1);

namespace App\Tasks;

class Book
{
    /**
     * @param  string[]  $authors
     */
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly array $authors,
        public readonly int $pubYear
    ) {}

    public function getInfo(): string
    {
        return sprintf(
            '#%d «%s» — %s, %d',
            $this->id,
            $this->title,
            implode(', ', $this->authors),
            $this->pubYear
        );
    }
}
