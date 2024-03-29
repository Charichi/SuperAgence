<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat',ChoiceType::class, [
                'choices' => $this->getHeating()
            ])
            ->add('city')
            ->add('address')
            ->add('postal_code')
            ->add('sold')
        ;
    }

    private function getHeating(){
        $heat = Property::HEAT;
        $output = [];
        foreach ($heat as $k => $v){
            $output[$v]=$k;
        }
        return $output;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
        ]);
    }
}
