<?php

namespace App;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BookGetter
{
    private string $endpoint = 'https://www.googleapis.com/books/v1/volumes';
    private string $key;

    public function __construct(
        private readonly HttpClientInterface $client
    ) {
        $this->key = $_ENV['GOOGLE_API_KEY'];
    }

    public function getBooks(array $context): array
    {
        $title = $context['title'] ?? '';
        $author = $context['author'] ?? '';

        $queryParameters = [
            'q' => $title,
            'inauthor' => $author,
            'key' => $this->key
        ];

        $response = $this->client->request('GET', $this->endpoint, [
            'query' => $queryParameters
        ]);

        $data = $response->toArray();

        return $data;
    }
}
