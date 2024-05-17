<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class BookUpdateType extends BookType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('author')
            ->add('publicationDate', null, [
                'widget' => 'single_text',
            ])
            ->add('isbn')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('updated_at', null, [
                'widget' => 'single_text',
            ])
            ->add('addedBy', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ]);
    }
}
