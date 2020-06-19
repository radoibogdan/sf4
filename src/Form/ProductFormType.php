<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class ProductFormType extends AbstractType
{
    // La description de la structure du formulaire
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder // grâce à lui on peut rajouter des champs
            ->add('name', TextType::class,[
                // les contraintes va validation
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez indiquer un nom.']), // message en cas d'erreur
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Le nom ne peut contenir plus de 255 caractères.'
                    ])
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'help'     => 'Ce champ est facultatif.' // un message d'aide pour les utilisateurs
            ])
            ->add('price', MoneyType::class,[
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez indiquer un prix.']),
                    new Positive(['message' => 'Le prix doit être positif'])
                ]
            ])
            ->add('quantity',IntegerType::class,[
                'constraints' => [
                    new NotBlank(['message'=> 'Veuillez indiquer une quantité.']),
                    new PositiveOrZero(['message'=> 'La quantité ne peut être négative.'])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // c'est cette ligne qui fait que le formulaire est lié à la classe
            'data_class' => Product::class,
        ]);
    }
}
