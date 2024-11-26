<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business;

use Pyz\Zed\AntelopeLocationSearch\AntelopeLocationSearchDependencyProvider;
use Pyz\Zed\AntelopeLocationSearch\Business\Writer\AntelopeLocationSearchWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class AntelopeLocationSearchBusinessFactory extends AbstractBusinessFactory
{
    public function createAntelopeLocationSearchWriter(): AntelopeLocationSearchWriter
    {
        return new AntelopeLocationSearchWriter($this->getEventBehaviorFacade());
    }

    private function getEventBehaviorFacade()
    {
        return $this->getProvidedDependency(AntelopeLocationSearchDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}
