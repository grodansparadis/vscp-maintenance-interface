<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VSCPTypeListType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('VscptypeName', EntityType::class, array(
              'class'    => 'AppBundle:VSCPType',
              'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->addSelect('t')
                    ->join('u.vscptypeclass', 't' )
                    ->orderBy('t.vscpclassName', 'ASC')
                    ->addOrderBy('u.vscptype', 'ASC');
              },
              'choice_label' => function($vscptypeName){
                return $vscptypeName->getvscptypeclass()->getvscpclassName() . " - " . $vscptypeName->getvscptypeName();
              },
              'placeholder' => 'Select a type',
              'multiple' => false,
              'expanded' => false,
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
