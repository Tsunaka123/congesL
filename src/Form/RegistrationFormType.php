<?php

namespace App\Form;

use App\Entity\Service;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomU', TextType::class, [
                'label' => 'Nom de famille : ',
                'mapped' => true,
            ])

            ->add('pnomU', TextType::class, [
                'label' => 'Prénom : ',
                'mapped' => true,
            ])

            ->add('mailU', EmailType::class, [
                'label' => 'Email : ',
                'mapped' => true,
            ])

            ->add('loginU', TextType::class, [
                'label' => 'Identifiant de connexion : ',
                'mapped' => true,
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe : '],
                'second_options' => ['label' => 'Confirmation : '],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])

            ->add('roles', ChoiceType::class, [
                'label' => 'Role :',
                'choices' => [
                    'User' => 'ROLE_USER',
                    'Valideur' => 'ROLE_VALIDATOR',
                    'DRH' => 'ROLE_DRH',
                    'Administrateur' => 'ROLE_ADMIN',
                    'super' => 'ROLE_SUPERADMIN',
                ],
                'expanded' => false,

                'multiple' => false,
            ])

            ->add('idServiceFromForm', EntityType::class, [
                'class' => Service::class,
                'label' => 'Choisir le service : ',
                'choice_label' => 'libService',
                'multiple' => true,
                'expanded' => true,
        ])

            ->add('commentaireU', TextareaType::class, [
                'label' => 'Commentaire',
                'required' => false,
                'attr' => [
                    'rows' => 5,
                    'placeholder' => 'Entrez votre commentaire ici...',
                ],
            ])

        ;

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                fn ($rolesAsArray) => count($rolesAsArray) ? $rolesAsArray[0]: null,
                fn ($rolesAsString) => [$rolesAsString]
            ));

    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
