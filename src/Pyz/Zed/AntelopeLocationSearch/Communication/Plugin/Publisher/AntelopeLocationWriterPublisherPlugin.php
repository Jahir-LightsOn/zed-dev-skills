<?php

namespace Pyz\Zed\AntelopeLocationSearch\Communication\Plugin\Publisher;

use Pyz\Shared\AntelopeLocationSearch\AntelopeLocationSearchConfig;
use Pyz\Shared\AntelopeSearch\AntelopeSearchConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;

/**
 * @method \Pyz\Zed\AntelopeLocationSearch\Business\AntelopeLocationSearchFacade getFacade()
 */
class AntelopeLocationWriterPublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    public function handleBulk(array $eventEntityTransfers, $eventName)
    {
        $this->getFacade()->writeCollectionByAntelopeLocationEvents($eventEntityTransfers);
    }

    public function getSubscribedEvents(): array
    {
        return [
            AntelopeLocationSearchConfig::ANTELOPE_LOCATION_PUBLISH,
            AntelopeLocationSearchConfig::ENTITY_PYZ_ANTELOPE_LOCATION_CREATE,
            AntelopeSearchConfig::ENTITY_PYZ_ANTELOPE_UPDATE
        ];
    }
}
