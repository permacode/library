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
        $this->isbn = $industryIdentifiers[0]['identifier'];
    }

    public function setAuthors(array $authors)
    {
        $this->author = implode(', ', $authors);
    }
}
