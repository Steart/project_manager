<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\ProjectHoursBookings;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class BookHourType
 * @package App\Form
 */
class BookHourType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('project', EntityType::class, [
                    // looks for choices from this entity
                    'class' => Project::class,

                    // uses the User.username property as the visible option string
                    'choice_label' => 'name',
                ]
            )
            ->add('date', DateType::class, [
                'format' => 'dd-MM-yyyy',
                'placeholder' => [
                    'year' => 'Jaar', 'month' => 'Maand', 'day' => 'Dag',
                ],
            ])
            ->add('hours', IntegerType::class)
            ->add('save', SubmitType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjectHoursBookings::class,
        ]);
    }
}
