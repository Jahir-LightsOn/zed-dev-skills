<?php

namespace Pyz\Zed\AntelopeLocationGui\Communication;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeLocationGui\AntelopeLocationGuiDependencyProvider;
use Pyz\Zed\AntelopeLocationGui\Communication\Form\AntelopeLocationCreateForm;
use Pyz\Zed\AntelopeLocationGui\Communication\Table\AntelopeLocationTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Form\FormInterface;

class AntelopeLocationGuiCommunicationFactory extends AbstractCommunicationFactory
{
    public function createAntelopeLocationTable(): AntelopeLocationTable
    {
        return new AntelopeLocationTable($this->getAntelopeLocationQuery());
    }

    private function getAntelopeLocationQuery(): PyzAntelopeLocationQuery
    {
        return $this->getProvidedDependency(AntelopeLocationGuiDependencyProvider::PROPEL_ANTELOPE_LOCATION_QUERY);
    }


    public function createAntelopeLocationCreateForm(AntelopeLocationTransfer $antelopeLocationTransfer, array $options = []): FormInterface
    {
        return $this->getFormFactory()->create(AntelopeLocationCreateForm::class, $antelopeLocationTransfer, $options);
    }

    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeLocationGuiDependencyProvider::FACADE_ANTELOPE);
    }
}
