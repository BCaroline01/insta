<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',TextType::class, [
                'label' => false,
                'attr' => array( 'placeholder' => 'Email',
                'class' => 'input_user',)
            ])
            ->add('name',TextType::class, [
                'label' => false,
                'attr' => array( 'placeholder' => 'Nom complet',
                'class' => 'input_user',)
            ])
            ->add('username',TextType::class, [
                'label' => false,
                'attr' => array( 'placeholder' => 'Nom d\'utilisateur',
                'class' => 'input_user',)
            ])
            ->add('password',PasswordType::class, [
                'label' => false,
                'attr' => array( 'placeholder' => 'Mot de passe',
                'class' => 'input_user',)
            ])
            ->add('dob', BirthdayType::class,[
                'label' => false,   
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
