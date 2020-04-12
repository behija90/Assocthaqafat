<?php

namespace App\Form;

use function PHPSTORM_META\type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffiliationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPrenom')
            ->add('dateLieuNaissance')
            ->add('nationalite')
            ->add('numCin')
            ->add('dateLieuEmission')
            ->add('profession')
            ->add('entreprise')
            ->add('adresse')
            ->add('email')
            ->add('telephone')
            ->add('categorieAffi', ChoiceType::class, array(
                    'choices' => array(
                        ' عـادي (20 د)   ' => 'عـــادي',
                        'طالـب (10 د) ' => 'طالـب ',
                        ' شرفي (المبلغ:.......)' => ' شرفي',
                        ),
                    'placeholder'=> 'إختر من هنا '
                )
            )
            ->add('image', ImageType::class, array(
                'label'=> 'صورة المنخرط',
                'required'=> is_null($builder->getData()->getId())

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
