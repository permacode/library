<?php

namespace App;

use App\Entity\Book;
use DateTime;
use DateTimeImmutable;

use function PHPUnit\Framework\throwException;

class BookBuilder
{
    static function buildBook(array $newBookArray, Book $book): ?Book
    {
        $isbn = $newBookArray['industryIdentifiers'][0]['type'] === "ISBN_13" ? $newBookArray['industryIdentifiers'][0]['identifier'] : 0;
        $book->setIsbn($isbn);

        $newTitle = isset($newBookArray['title']) ? $newBookArray['title'] : '';
        $book->setTitle($newTitle);

        $newAuthor = isset($newBookArray['authors']) ? $newBookArray['authors'][0] : '';
        $book->setAuthor($newAuthor);

        // TODO: Add a condition if the exactdate is not available
        // E.g : If the "publishedDate" item is only a year, the returned value will be the current date in this year.
        $book->setPublicationDate(new DateTime($newBookArray['publishedDate']));

        $book->setCreatedAt(new DateTimeImmutable());

        $book->setUpdatedAt(null);

        return $book;
    }
}
