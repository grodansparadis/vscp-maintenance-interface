<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class VSCPClassType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vscpclass')
            ->add('vscpclassName')
            ->add('vscpclassToken')
            ->add('vscpclassDescription', CKEditorType::class, array(
                'config' => array(
                'uiColor' => '#ffffff',
                'toolbar' => 'full',
                ),
            ))
        ;
    }


    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\VSCPClass'
        ));
    }
}
