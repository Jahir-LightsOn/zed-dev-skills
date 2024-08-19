<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class AntelopeLocationForm extends AbstractType
{
    public const FIELD_NAME = 'location_name';

    public function getBlockPrefix(): string
    {
        return 'antelope_location';
    }

    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $this->addNameField($builder);
    }

    protected function addNameField(FormBuilderInterface $builder): static
    {
        $builder->add(static::FIELD_NAME, TextType::class, [
            'label' => 'Name',
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        return $this;
    }
}
