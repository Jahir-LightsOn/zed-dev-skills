<?php

namespace Pyz\Zed\AntelopeGui\Communication;

use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeGui\AntelopeGuiDependencyProvider;
use Pyz\Zed\AntelopeGui\Communication\Form\AntelopeCreateForm;
use Pyz\Zed\AntelopeGui\Communication\Table\AntelopeTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Form\FormInterface;

class AntelopeGuiCommunicationFactory extends AbstractCommunicationFactory
{
    public function createAntelopeTable(): AntelopeTable
    {
        return new AntelopeTable($this->getAntelopeQuery(), $this->getAntelopeFacade());
    }

    private function getAntelopeQuery(): PyzAntelopeQuery
    {
        return $this->getProvidedDependency(AntelopeGuiDependencyProvider::PROPEL_ANTELOPE_QUERY);
    }

    public function createAntelopeCreateForm(AntelopeTransfer $antelopeTransfer, array $options = []): FormInterface
    {
        $options['data']['antelope_locations'] = $this->getAntelopeLocationChoices();
        return $this->getFormFactory()->create(AntelopeCreateForm::class, $antelopeTransfer, $options);
    }

    private function getAntelopeLocationChoices(): array
    {
        $antelopeLocationCollection = $this->getAntelopeFacade()->getAntelopeLocationCollection();
        $choices = [];
        foreach ($antelopeLocationCollection as $antelopeLocationResponseTransfer) {
            $antelopeLocationTransfer = $antelopeLocationResponseTransfer->getAntelopeLocation();
            $choices[$antelopeLocationTransfer->getLocationName()] = $antelopeLocationTransfer->getIdAntelopeLocation();
        }
        return $choices;
    }

    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeGuiDependencyProvider::FACADE_ANTELOPE);
    }

}
