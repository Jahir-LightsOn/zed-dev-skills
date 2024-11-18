<?php

namespace Pyz\Zed\AntelopeGui;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AntelopeGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PROPEL_ANTELOPE_QUERY = 'PROPEL_ANTELOPE_QUERY';

    public const FACADE_ANTELOPE = 'FACADE_ANTELOPE';
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addAntelopeQuery($container);
        $container = $this->addAntelopeFacade($container);
        return $container;
    }

    private function addAntelopeQuery(Container $container): Container
    {
        $container->set(self::PROPEL_ANTELOPE_QUERY, $container->factory(function(){
            return PyzAntelopeQuery::create();
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
