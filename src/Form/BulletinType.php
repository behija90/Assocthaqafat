<?php

namespace App\Form;

use App\Entity\Bulletin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BulletinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreAr')
            ->add('descriptionAr')
            ->add('titreEn')
            ->add('descriptionEn')
            ->add('publier', CheckboxType::class, array(
                'required' => false,
                'label' => "نشر ",
                'attr' => array('class' => 'ace ace-switch ace-switch-3')))
            ->add('file', FileType::class, array(
                'required'=> is_null($builder->getData()->getId())
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bulletin::class,
        ]);
    }
}
