<?php

namespace UTT\CursusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class ElementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('semSeq',IntegerType::class)
        ->add('semLabel',EntityType::class,array(
                'class'=>'UTTCursusBundle:SemLabel',
                'choice_label'=>'nom',
                'multiple'=>false,
            )

        )->add('sigle')->add('categorie',EntityType::class,array(
                    'class'=>'UTTCursusBundle:Categorie',
                    'choice_label'=>'nom',
                    'multiple'=>false,
                )
            )->add('affectation',EntityType::class,array(
                'class'=>'UTTCursusBundle:Affectation',
                'choice_label'=>'nom',
                'multiple'=>false,
                )
            )->add('utt',CheckboxType::class,array('required'=>false))->add('profil',CheckboxType::class,array('required'=>false))->add('credit',IntegerType::class
            )->add('resultat',EntityType::class,array(
                'class'=>'UTTCursusBundle:Resultat',
                'choice_label'=>'nom',
                'multiple'=>false,
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UTT\CursusBundle\Entity\Element'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'utt_cursusbundle_element';
    }


}
