<?php

namespace Pyz\Glue\AntelopesBackendApi;

use Spryker\Glue\Kernel\Backend\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Backend\Container;

class AntelopesBackendApiDependencyProvider extends AbstractBundleDependencyProvider
{
    const FACADE_ANTELOPE = 'FACADE_ANTELOPE';

    public function provideBackendDependencies(Container $container): Container
    {
        $container = parent::provideBackendDependencies($container);
        $container = $this->addAntelopeFacade($container);
        return $container;
    }

    private function addAntelopeFacade(Container $container)
    {
        $container->set(static::FACADE_ANTELOPE, function (Container $container) {
            return $container->getLocator()->antelope()->facade();
        });
        return $container;
    }

}
