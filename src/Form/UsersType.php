<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',TextType::class, [
                'label' => false,
                'attr' => array( 'placeholder' => 'Email')
            ])
            ->add('name',TextType::class, [
                'label' => false,
                'attr' => array( 'placeholder' => 'Nom complet')
            ])
            ->add('username',TextType::class, [
                'label' => false,
                'attr' => array( 'placeholder' => 'Nom d\'utilisateur')
            ])
            ->add('password',PasswordType::class, [
                'label' => false,
                'attr' => array( 'placeholder' => 'Mot de passe')
            ])
            ->add('dob', DateType::class,[
                'label' => false,
                'html5' => false,
                'format' => 'MMMMddyyyy',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
