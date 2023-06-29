<?php

namespace App\Form;

use App\Entity\Model;
use App\Entity\Phone;
use App\Entity\State;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isBlocked', ChoiceType::class, [
                'choices'  => [
                    'Non' => false,
                    'Oui' => true,
                ], 
                'label' => 'Est-il bloqué ?',
                'label_attr' => [
                    'class' => 'text-light pt-4',
                ],
             ],)

            ->add('model',
            EntityType::class,
            [
                'label' => 'Modèle',
                'label_attr' => [
                    'class' => 'text-light pt-4',
                ],
                'class' => Model::class,
                'choice_label' => 'name',
            ],)

            ->add('etat',
            EntityType::class,
            [
                'label' => 'État',
                'label_attr' => [
                    'class' => 'text-light pt-4',
                ],
                'class' => State::class,
                'choice_label' => 'name',
            ],)

            ->add('picture',
            null,
            [
                'label' => 'Image',
                'label_attr' => [
                    'class' => 'text-light pt-4',
                ],
            ],);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Phone::class,
        ]);
    }
}
