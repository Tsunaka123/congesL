<?php

namespace App\Form;

use App\Entity\CongesDemande;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NouveauCongesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options,)
    {
        $delegationFromController = $options['delegationFromController'];

        $keys = array_keys($delegationFromController);
        $values = array_values($delegationFromController);

        $builder

            ->add('delegationBoolFromForm', CheckboxType::class, [
                'label' => 'Delegation ?',
                'required' => false,
            ])

            ->add('listDelegationFromForm', ChoiceType::class, [
                'label' => "Liste des délégations :",
                'choices' => array_combine($values, $keys),
            ])

            ->add('typeDeConges', TextType::class, [
                'label' => "Type de congés : ",
                'required' => true,
            ])

            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début : ',
                'html5' => true,
                'format' => 'yyyy-MM-dd'
            ])

            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin : ',
                'html5' => true,
                'format' => 'yyyy-MM-dd'
            ])

            ->add('informationsComplementaire', TextType::class, [
                'label' => "Informations complémentaire : ",
                'required' => false,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('delegationFromController');
        $resolver->setDefaults([
            'data_class' => CongesDemande::class,
            ]);
    }
}