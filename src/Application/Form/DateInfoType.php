<?php

declare(strict_types=1);

namespace Application\Form;

use Application\DTO\DateInfoDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Timezone;

class DateInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', TextType::class, [
                'label' => 'Date (Y-m-d)',
                'constraints' => [
                    new NotBlank(),
                    new Date(), // validates Y-m-d format
                ],
            ])
            ->add('timezone', TextType::class, [
                'label' => 'Timezone',
                'constraints' => [
                    new NotBlank(),
                    new Timezone(),
                ],
            ])
            ->add('submit', SubmitType::class, []);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DateInfoDTO::class,
        ]);
    }

}