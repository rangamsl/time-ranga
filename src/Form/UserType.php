<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class,[
            'attr' => array('class' => 'form-control m-b')
        ])
            ->add('email', EmailType::class,[
                'attr' => array('class' => 'form-control m-b')
            ])
            ->add('plainPassword', RepeatedType::class, [
                'attr' => array('class' => 'form-control m-b'),
                'type' => PasswordType::class ,'attr' => array('class' => 'form-control m-b'),
                'first_options' => ['label' => 'Password',
                'attr' => array('class' => 'form-control m-b')],
                'second_options' => ['label' => 'Repated password',
                'attr' => array('class' => 'form-control m-b')]

            ])
            ->add('fullName', TextType::class,[
                'attr' => array('class' => 'form-control m-b')
            ])
            ->add('termsAgreed', CheckboxType::class, [
                'mapped' => false,
                'constraints' => new IsTrue(),
                'label' => 'I agree to the terms of service ',
                'attr' => array('class' => 'i-checks')
            ])
            ->add('Register', SubmitType::class ,[
                'attr' => array('class' => 'btn btn-primary')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

}