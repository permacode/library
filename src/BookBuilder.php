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
        $book->setIsbn($isbn);

        $newTitle = isset($newBook['title']) ? $newBook['title'] : '';
        $book->setTitle($newTitle);
        
        $newAuthor = isset($newBook['authors']) ? $newBook['authors'][0] : '';
        $book->setAuthor($newAuthor);

        $book->setPublicationDate(new DateTime($newBook['publishedDate']));

        $book->setCreatedAt(new DateTimeImmutable());

        return $book;
    }
}
