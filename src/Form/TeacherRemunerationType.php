<?php

namespace App\Form;

use App\Entity\Classroom;
use App\Entity\Matter;
use App\Entity\TeacherRemuneration;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherRemunerationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount')
            ->add('teacher')
            ->add('matter', EntityType::class, [
                "class" => Matter::class,

            ])
            ->add('classroom', EntityType::class, [
                "class" => Classroom::class,

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TeacherRemuneration::class,
        ]);
    }
}
