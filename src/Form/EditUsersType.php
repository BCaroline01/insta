<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditUsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('name',TextType::class, [
                'label' => 'Nom',
                'attr' => array( 'placeholder' => 'Nom',
                'class' => 'input_user',)
            ])
            ->add('username',TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'attr' => array( 'placeholder' => 'Nom d\'utilisateur',
                'class' => 'input_user',)
            ])
            ->add('description',TextareaType::class, [
                'label' => 'Bio',
                'required' => false,
            ])
            ->add('email',EmailType::class, [
                'label' => 'Adresse e-mail',
                'attr' => array( 'placeholder' => 'Email',)
            ])
            ->add('phone',TextType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => array( 'placeholder' => 'Numéro de téléphone',)
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
