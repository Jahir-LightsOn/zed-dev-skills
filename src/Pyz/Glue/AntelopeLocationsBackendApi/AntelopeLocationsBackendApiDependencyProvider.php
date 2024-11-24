<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Backend\Container;

class AntelopeLocationsBackendApiDependencyProvider extends AbstractBundleDependencyProvider
{
    const FACADE_ANTELOPE_LOCATION = 'FACADE_ANTELOPE_LOCATION';
    public function provideBackendDependencies(Container $container): Container
    {
        $container = parent::provideBackendDependencies($container);
        $container = $this->addAntelopeLocationFacade($container);
        return $container;
    }

    private function addAntelopeLocationFacade(Container $container): Container
    {
        $container->set(static::FACADE_ANTELOPE_LOCATION, function (Container $container) {
            return $container->getLocator()->antelopeLocation()->facade();
        });
        return $container;
    }

}
