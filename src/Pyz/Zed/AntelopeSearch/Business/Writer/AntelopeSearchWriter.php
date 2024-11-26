<?php

namespace Pyz\Zed\AntelopeSearch\Business\Writer;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Orm\Zed\AntelopeSearch\Persistence\PyzAntelopeSearchQuery;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class AntelopeSearchWriter
{
    public function __construct(private readonly EventBehaviorFacadeInterface $eventBehaviorFacade)
    {
    }

    public function writeCollectionByAntelopeEvents(array $eventTransfers): void
    {
        $antelopeIds = $this->eventBehaviorFacade->getEventTransferIds($eventTransfers);
        $this->writeCollectionByAntelopeIds($antelopeIds);
    }

    private function writeCollectionByAntelopeIds(array $antelopeIds): void
    {
        if (!$antelopeIds) {
            return;
        }

        foreach ($antelopeIds as $antelopeId) {
            $antelopeEntity = PyzAntelopeQuery::create()->filterByIdAntelope($antelopeId)->findOne();
            $searchEntity = PyzAntelopeSearchQuery::create()
                ->filterByFkAntelope($antelopeId)
                ->findOneOrCreate();
            $searchEntity->setFkAntelope($antelopeId);
            $searchEntity->setData($antelopeEntity->toArray());
            $searchEntity->save();
        }
    }
}
