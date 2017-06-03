<?php

namespace UTT\CursusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ElementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('semSeq',TextType::class)
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
            )->add('utt',CheckboxType::class)->add('profil',CheckboxType::class)->add('credit')->add('resultat');
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
