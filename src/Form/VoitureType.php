<?php

namespace App\Form;

use App\Entity\Voiture;
use App\Enum\BoiteCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('description', TextareaType::class)
            ->add('tarifMois', NumberType::class, [
                'invalid_message' => 'Veuillez saisir un nombre valide.',
            ])
            ->add('tarifJour', NumberType::class, [
                'invalid_message' => 'Veuillez saisir un nombre valide.',
            ])
            ->add('places', ChoiceType::class, [
                'choices' => array_combine(range(1, 9), range(1, 9)),
                'label' => 'Nombre de places',
            ])
            ->add('boite', EnumType::class, ['class' => BoiteCategories::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
