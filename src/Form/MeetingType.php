<?php

namespace App\Form;

use App\Entity\Meeting;
use App\Entity\Procedure;
use App\Entity\User;
use App\Repository\ProcedureRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class MeetingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'date',
                DateType::class,
                [
                    'widget' => 'single_text',
                ]
            )
            ->add(
                'doctor',
                EntityType::class,
                [
                    'class' => User::class,
                    'query_builder' => function (UserRepository $userRepository) {
                        return $userRepository->getAllWithRoleQB(User::ROLE_DOCTOR);
                    },
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                'patient',
                EntityType::class,
                [
                    'class' => User::class,
                    'query_builder' => function (UserRepository $userRepository) {
                        return $userRepository->getAllWithRoleQB(User::ROLE_USER);
                    },
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                'procedures',
                EntityType::class,
                [
                    'class' => Procedure::class,
                    'query_builder' => function (ProcedureRepository $procedureRepository) {
                        return $procedureRepository->getAllQB();
                    },
                    'multiple' => true
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Meeting::class,
            ]
        );
    }
}
