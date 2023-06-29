<?php

namespace App\Form;

use App\Entity\Model;
use App\Entity\Phone;
use App\Entity\State;
use App\Entity\PhoneSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhoneSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('min_price', NumberType::class, [
                'label' => 'Prix minimum',
                'required' => false,
                'label_attr' => [
                    'class' => 'text-light pt-4',
                ],
            ])
            ->add('max_price', NumberType::class, [
                'label' => 'Prix maximum',
                'required' => false,
                'label_attr' => [
                    'class' => 'text-light pt-4',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => PhoneSearch::class
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
