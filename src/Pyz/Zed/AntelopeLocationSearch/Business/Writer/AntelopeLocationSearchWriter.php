<?php

namespace Pyz\Zed\AntelopeLocationSearch\Business\Writer;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Orm\Zed\AntelopeLocationSearch\Persistence\PyzAntelopeLocationSearchQuery;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class AntelopeLocationSearchWriter
{
    public function __construct(private readonly EventBehaviorFacadeInterface $eventBehaviorFacade)
    {
    }

    public function writeCollectionByAntelopeLocationEvents(array $eventTransfers): void
    {
        $antelopeLocationIds = $this->eventBehaviorFacade->getEventTransferIds($eventTransfers);
        $this->writeCollectionByAntelopeLocationIds($antelopeLocationIds);
    }

    private function writeCollectionByAntelopeLocationIds(array $antelopeLocationIds): void
    {
        if (!$antelopeLocationIds) {
            return;
        }

        foreach ($antelopeLocationIds as $antelopeLocationId) {
            $antelopeLocationEntity = PyzAntelopeLocationQuery::create()
                ->filterByIdAntelopeLocation($antelopeLocationId)
                ->findOne();
            $searchEntity = PyzAntelopeLocationSearchQuery::create()
                ->filterByFkAntelopeLocation($antelopeLocationId)
                ->findOneOrCreate();
            $searchEntity->setFkAntelopeLocation($antelopeLocationId);
            $searchEntity->setData($antelopeLocationEntity->toArray());
            $searchEntity->save();
        }
    }
}
