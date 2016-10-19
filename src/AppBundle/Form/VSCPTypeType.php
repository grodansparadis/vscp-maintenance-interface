<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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

            ->add('vscptypeclass', EntityType::class, array(
              'class'    => 'AppBundle:VSCPClass',
              'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.vscpclassName', 'ASC');
              },
              'choice_label' => 'vscpclassName',
              'multiple' => false,
              'expanded' => false
                ))

            ->add('vscptypeDescription')
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
