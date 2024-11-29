<?php

namespace Pyz\Yves\AntelopePage;

use Pyz\Client\AntelopeSearch\AntelopeSearchClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class AntelopePageFactory extends AbstractFactory
{
    public function getAntelopeSearchClient(): AntelopeSearchClientInterface
    {
        return $this->getProvidedDependency(AntelopePageDependencyProvider::CLIENT_ANTELOPE_SEARCH);
    }
}
