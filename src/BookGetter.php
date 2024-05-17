<?php

namespace App;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BookGetter
{
    private string $endpoint;
    private string $key;

    public function __construct(
        private readonly HttpClientInterface $client
    ) {
        $this->key = $_ENV['GOOGLE_API_KEY'];
    }

    public function getBooks(array $context): array
    {
        $title = $context['title'];
        $author = $context['author'];

        $this->endpoint = \sprintf(
            'https://www.googleapis.com/books/v1/volumes?q=%s+inauthor:%s&key=%s',
            $title,
            $author,
            $this->key
        );
        $response = $this->client->request('GET', $this->endpoint);
        dump($response);
        return $arrayName = array($response);
    }
}
