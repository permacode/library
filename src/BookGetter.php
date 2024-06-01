<?php

namespace App;

use OutOfBoundsException;
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

    public function getBookSearchResult(array $context): array
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

        $result = $response->toArray();

        return $this->getBookData($result);
    }

    public function getBookData(array $result): array
    {
        try {
            return $result['items'][0]['volumeInfo'];
        } catch (\Throwable $th) {
            throw new OutOfBoundsException("There was an error when decomposing the result array.");
        }
    }
}
