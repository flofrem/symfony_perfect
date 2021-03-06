<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Type;
use App\Entity\Brand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('Price')
            ->add('Stock')
            ->add('type',EntityType::class,[
                'class' => Type::class,
                'choice_label'=>'name',       ])

            ->add('Brand',EntityType::class,[
                'class' => Brand::class,
                'choice_label'=>'name', ])

            ->add('submit', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
