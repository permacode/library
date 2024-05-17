<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'book_index')]
    public function index(BookRepository $bookRepo): Response
    {
        return $this->render('book/index.html.twig', [
            'books' => $bookRepo->findAll(),
            'controller_name' => 'BookController',
        ]);
    }
}
