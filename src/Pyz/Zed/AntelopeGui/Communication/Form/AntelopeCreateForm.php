<?php

namespace Pyz\Zed\AntelopeGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class AntelopeCreateForm extends AbstractType
{
    public const FIELD_NAME = 'name';

    public const FIELD_ANTELOPE_LOCATION_ID = 'fkAntelopeLocation';

    public function getBlockPrefix(): string
    {
        return 'antelope';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $locationChoices = $options['data']['antelope_locations'] ?? [];
        $this->addNameField($builder)->addAntelopeLocationField($builder, $locationChoices);
    }

    protected function addNameField(FormBuilderInterface $builder)
    {
        $builder->add(static::FIELD_NAME, TextType::class, [
            'label' => 'Name',
            'constraints' => [
                $this->createNotBlankConstraint(),
            ],
        ]);

        return $this;
    }

    protected function createNotBlankConstraint(): NotBlank
    {
        return new NotBlank();
    }

    private function addAntelopeLocationField(FormBuilderInterface $builder, array $locationChoices)
    {
        $builder->add(static::FIELD_ANTELOPE_LOCATION_ID, ChoiceType::class, [
            'label' => 'Location',
            'choices' => $locationChoices,
            'constraints' => [
                $this->createNotBlankConstraint(),
            ],
        ]);

        return $this;
    }
}
