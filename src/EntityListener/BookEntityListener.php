<?php

namespace App\EntityListener;

use App\Entity\Book;
use App\Entity\User;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Symfony\Bundle\SecurityBundle\Security;

#[AsEntityListener(event: Events::preUpdate, entity: Book::class)]
#[AsEntityListener(event: Events::prePersist, entity: Book::class)]
class BookEntityListener
{
    public function __construct(
        private SluggerInterface $slugger,
        private Security $security,
    ) {
    }
    public function __invoke(Book $book, LifecycleEventArgs $event)
    {
        $book->computeSlug($this->slugger);
        $book->setAddedBy($this->security->getUser());
        // TODO: make this work : Currently getUsers() methods returns a UserInterface instead of a User
        // $loggedUser = $this->security->getUser();
        // $loggedUser->addBooksAdded($book);
    }
}
