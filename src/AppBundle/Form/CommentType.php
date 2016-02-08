<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("message", TextareaType::class, [
                'label' => 'Message',
                'attr' => ['class' => 'form-control']
            ])
//            ->add("article", EntityType::class, [
//                'choice_label' => 'title',
//                'attr' => ['class' => 'form-control'],
//                'class' => 'AppBundle\Entity\Article'
//            ])
//            ->add("user", EntityType::class, [
//                'choice_label' => 'username',
//                'attr' => ['class' => 'form-control'],
//                'class' => 'AppBundle\Entity\User'
//            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Comment'
        ]);
    }
    public function getName()
    {
        return 'comment';
    }
}