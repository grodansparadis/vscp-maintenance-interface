<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class VSCPTypeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vscptype')
            ->add('vscptypeName')

            ->add('vscptypeclass', EntityType::class, array(
              'class'    => 'AppBundle:VSCPClass',
              'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.vscpclass', 'ASC');
              },
              'choice_label' => 'vscpclassName',
              'placeholder' => 'Select a class',
              'multiple' => false,
              'expanded' => false
                ))

            ->add('vscptypeDescription', CKEditorType::class, array(
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
            'data_class' => 'AppBundle\Entity\VSCPType'
        ));
    }
}
