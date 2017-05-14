<?php

namespace UTT\EtuBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EtudiantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idEtudiant',TextType::class)->add('nom',TextType::class)->add('prenom',TextType::class)
        ->add('admission',EntityType::class,array(
            'class'=>'UTTEtuBundle:Admission',
            'choice_label'=>'nom',
            'multiple'=>false))
            ->add('filliere',EntityType::class,array(
            'class'=>'UTTEtuBundle:Filliere',
                    'choice_label'=>'nom',
                    'multiple'=>false,
                )

            );

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UTT\EtuBundle\Entity\Etudiant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'utt_etubundle_etudiant';
    }


}
