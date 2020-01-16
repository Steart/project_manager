<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProjectType
 * @package App\Form
 */
class ProjectType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('address', AddressType::class, ['required' => false])
            ->add('start_date', DateType::class, [
                'format' => 'dd-MM-yyyy',
                'placeholder' => [
                    'year' => 'Jaar', 'month' => 'Maand', 'day' => 'Dag',
                ],
                'required' => false,
            ])
            ->add('contact', EntityType::class, [
                    // looks for choices from this entity
                    'class' => Contact::class,

                    // uses the User.username property as the visible option string
                    'choice_label' => 'name',
                    'placeholder' => '-- Selecteer Contact --'
                ]
            )
            ->add('is_visible', CheckboxType::class, ['required' => false])
            ->add('save', SubmitType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
