<?php

namespace App\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use App\Dto\BookDto;

class GoogleBookClient
{

    public function __construct(
        private HttpClientInterface $client,
        private DenormalizerInterface $denormalizer,
    ) {
    }

    public function searchBook(string $title, string $author): BookDto
    {
        $response = $this->client
            ->request('GET', 'https://www.googleapis.com/books/v1/volumes', [
                'query' => [
                    'q' => 'intitle:' . $title . '+inauthor:' . $author,
                    'maxResults' => 1,
                    'langRestrict' => "fr",
                ],
            ]);

        $result = $response->toArray();

        $bookDto = $this->denormalizer->denormalize($result['items'][0]['volumeInfo'], BookDto::class);

        return $bookDto;
    }
}
