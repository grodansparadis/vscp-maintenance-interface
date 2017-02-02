<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VSCPByteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vscpbyte')
            ->add('vscpbytetype', EntityType::class, array(
              'class'    => 'AppBundle:VSCPType',
              'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->join('u.vscptypeclass', 't' )
                    ->orderBy('t.vscpclass', 'ASC')
                    ->addOrderBy('u.vscptype', 'ASC');
              },
              'choice_label' => function($vscptypeName){
                return $vscptypeName->getvscptypeclass()->getvscpclassName() . " - " . $vscptypeName->getvscptypeName();
              },
              'placeholder' => 'Select a type',
              'multiple' => false,
              'expanded' => false
                ))

            ->add('vscpbyteDescription')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\VSCPByte'
        ));
    }
}
