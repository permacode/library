<?php

namespace App\EntityListener;

use App\Entity\Admin;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs as EventLifecycleEventArgs;

#[AsEntityListener(event: Events::prePersist, entity: Admin::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Admin::class)]
class AdminEntityListener
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function __invoke(Admin $user, EventLifecycleEventArgs $event)
    {
        $user->hashPassword($this->passwordHasher);
    }
}
