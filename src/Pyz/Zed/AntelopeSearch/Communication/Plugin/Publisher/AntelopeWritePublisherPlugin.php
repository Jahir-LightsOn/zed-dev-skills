<?php

namespace Pyz\Zed\AntelopeSearch\Communication\Plugin\Publisher;

use Pyz\Shared\AntelopeSearch\AntelopeSearchConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;

/**
 * @method \Pyz\Zed\AntelopeSearch\Business\AntelopeSearchFacade getFacade()
 */
class AntelopeWritePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{

    /**
     * @inheritDoc
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $this->getFacade()->writeCollectionByAntelopeEvents($eventEntityTransfers);
    }

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents(): array
    {
        return [
            AntelopeSearchConfig::ENTITY_PYZ_ANTELOPE_CREATE,
            AntelopeSearchConfig::ENTITY_PYZ_ANTELOPE_UPDATE,
            AntelopeSearchConfig::ANTELOPE_PUBLISH
        ];
    }
}
