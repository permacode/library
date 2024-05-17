<?php

namespace App;

use App\Entity\Book;
use DateTime;
use DateTimeImmutable;

use function PHPUnit\Framework\throwException;

class BookBuilder
{
    static function buildBook(array $newBook, Book $book): ?Book
    {
        \dump($newBook);

        $isbn = $newBook['industryIdentifiers'][0]['type'] === "ISBN_13" ? $newBook['industryIdentifiers'][0]['identifier'] : 0;
        if (
            isset($newBook['title']) &&
            isset($newBook['authors']) &&
            isset($newBook['publishedDate'])
        ) {
            $book->setTitle($newBook['title']);
            $book->setAuthor($newBook['authors'][0]);
            $book->setPublicationDate(new DateTime($newBook['publishedDate']));
            if ($newBook)
                $book->setIsbn($isbn);
            $book->setCreatedAt(new DateTimeImmutable());

            return $book;
        }

        return null;
    }
}
