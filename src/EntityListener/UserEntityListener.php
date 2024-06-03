<?php

namespace App\EntityListener;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: User::class)]
#[AsEntityListener(event: Events::preUpdate, entity: User::class)]
class UserEntityListener
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function __invoke(User $user)
    {
        dump('UserEntityListener invoked');
        if ($this->passwordHasher->needsRehash($user)) {
            dump('needs rehash !');
            $user->hashPassword($this->passwordHasher);
        }
    }
}
