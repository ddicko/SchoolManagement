<?php

namespace App\Form;

use App\Entity\Enseignant;
use App\Entity\Matter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null, [
                'label'=>'Prénom'
            ])
            ->add('lastname', null, [
                'label'=>'Nom'
            ])
            ->add('phonenumbers', null, [
                'label'=>'Numéros de téléphone'
            ])
            ->add('age', null, [
                'label'=>'Date de naissance'
            ])
            ->add('address', null, [
                'label'=>'Adresse'
            ])
            ->add('siteweb', null, [
                'label'=>'Site Web'
            ])
            ->add('speciality', EntityType::class, [
                'class'=>Matter::class,
                'choice_label'=>'name',
                'expanded'     => true,
                'multiple'     => true,
            ])
            ->add('Creer', SubmitType::class)
            //, EntityType::class, [
            //     'class' => Matter::class,
            //     'multiple' => true,
            //     'expanded' => true,

            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enseignant::class,
        ]);
    }
}
