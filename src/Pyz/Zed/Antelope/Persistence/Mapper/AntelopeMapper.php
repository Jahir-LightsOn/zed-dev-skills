<?php

namespace Pyz\Zed\Antelope\Persistence\Mapper;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\AntelopeTypeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Propel\Runtime\Collection\ObjectCollection;

class AntelopeMapper implements AntelopeMapperInterface
{
    public function mapAntelopeEntityToAntelopeTransfer(PyzAntelope $antelopeEntity, AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        $antelopeTransfer =  $antelopeTransfer->fromArray($antelopeEntity->toArray(), true);

        // Map AntelopeType
        if ($antelopeEntity->getPyzAntelopeType()) {
            $antelopeTypeTransfer = new AntelopeTypeTransfer();
            $antelopeTypeTransfer->fromArray($antelopeEntity->getPyzAntelopeType()->toArray(), true);
            $antelopeTransfer->setType($antelopeTypeTransfer);
        }

        // Map AntelopeLocation
        if ($antelopeEntity->getPyzAntelopeLocation()) {
            $antelopeLocationTransfer = new AntelopeLocationTransfer();
            $antelopeLocationTransfer->fromArray($antelopeEntity->getPyzAntelopeLocation()->toArray(), true);
            $antelopeTransfer->setLocation($antelopeLocationTransfer);
        }

        return $antelopeTransfer;
    }

    public function mapAntelopeTransferToAntelopeEntity(AntelopeTransfer $antelopeTransfer, PyzAntelope $antelopeEntity): PyzAntelope
    {
        return $antelopeEntity->fromArray($antelopeTransfer->toArray());
    }

    public function mapAntelopeCollectionToAntelopeTransferCollection(ObjectCollection $antelopeEntities, AntelopeCollectionTransfer $antelopeCollectionTransfer): AntelopeCollectionTransfer
    {
        foreach ($antelopeEntities as $antelopeEntity) {
            $antelopeTransfer = new AntelopeTransfer();
            $this->mapAntelopeEntityToAntelopeTransfer($antelopeEntity, $antelopeTransfer);
            $antelopeCollectionTransfer->addAntelope($antelopeTransfer);
        }

        return $antelopeCollectionTransfer;
    }
}
