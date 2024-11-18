<?php

namespace Pyz\Zed\AntelopeLocationGui;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AntelopeLocationGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PROPEL_ANTELOPE_LOCATION_QUERY = 'PROPEL_ANTELOPE_LOCATION_QUERY';
    public const FACADE_ANTELOPE = 'FACADE_ANTELOPE';
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addAntelopeLocationQuery($container);
        $container = $this->addAntelopeFacade($container);
        return $container;
    }

    private function addAntelopeLocationQuery(Container $container): Container
    {
        $container->set(self::PROPEL_ANTELOPE_LOCATION_QUERY, $container->factory(function(){
            return PyzAntelopeLocationQuery::create();
        }));

        return $container;
    }

    protected function addAntelopeFacade(Container $container): Container
    {
        $container->set(static::FACADE_ANTELOPE, function (Container $container) {
            return $container->getLocator()->antelope()->facade();
        });

        return $container;
    }
}
