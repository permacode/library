<?php

namespace App\Dto;

final readonly class BookDto
{
    public string $author;
    public string $isbn;

    public function __construct(
        public string $title,
        public \DateTimeImmutable $publishedDate,
    ) {
    }

    public function setIndustryIdentifiers(array $industryIdentifiers)
    {
        $this->isbn = \substr($industryIdentifiers[0]['identifier'], 0, 13);
    }

    public function setAuthors(array $authors)
    {
        $this->author = implode(', ', $authors);
    }
}
