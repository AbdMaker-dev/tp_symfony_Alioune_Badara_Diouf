<?php

namespace App\Form;

use App\Entity\Chambres;
use App\Entity\Etudiants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class EtudiantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('tel')
            ->add('email')
            ->add('nee_at', DateType::class)
            
            ->add('bourse', ChoiceType::class, [
                'choices'  => [
                    'Pas de Bourse' => null,
                    'Demis-bourse' => 20000,
                    'Bourse-exelent' => 40000,
                ],
            ])
            ->add('chambre',EntityType::class,[
                'class'=>Chambres::class,
                'placeholder' => 'Liste des chambres',
                'choice_label' => function($chambre){
                    return $chambre->getNumChambre();
                }
            ])
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiants::class,
        ]);
    }
}
