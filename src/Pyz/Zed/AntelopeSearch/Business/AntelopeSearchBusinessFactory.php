<?php

namespace Pyz\Zed\AntelopeSearch\Business;

use Pyz\Zed\AntelopeSearch\AntelopeSearchDependencyProvider;
use Pyz\Zed\AntelopeSearch\Business\Writer\AntelopeSearchWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class AntelopeSearchBusinessFactory extends AbstractBusinessFactory
{
    public function createAntelopeSearchWriter(): AntelopeSearchWriter
    {
        return new AntelopeSearchWriter($this->getEventBehaviorFacade());
    }

    private function getEventBehaviorFacade()
    {
        return $this->getProvidedDependency(AntelopeSearchDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}
