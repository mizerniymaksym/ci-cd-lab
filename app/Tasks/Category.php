<?php

declare(strict_types=1);

namespace App\Tasks;

class Category
{
    /**
     * @param  Book[]  $books
     */
    public function __construct(
        private int $categoryId,
        private string $name,
        private array $books = []
    ) {}

    public function addBook(Book $book): void
    {
        $this->books[$book->id] = $book;
    }

    public function removeBook(int $id): bool
    {
        if (! isset($this->books[$id])) {
            return false;
        }

        unset($this->books[$id]);

        return true;
    }

    /**
     * @return Book[]
     */
    public function searchBook(string $title): array
    {
        return array_values(array_filter(
            $this->books,
            fn (Book $book): bool => mb_stripos($book->title, $title) !== false
        ));
    }

    /**
     * @return Book[]
     */
    public function getBooks(): array
    {
        return array_values($this->books);
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
