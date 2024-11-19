<?php

namespace Pyz\Zed\Antelope\Persistence\Mapper;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Propel\Runtime\Collection\ObjectCollection;

interface AntelopeMapperInterface
{
    public function mapAntelopeEntityToAntelopeTransfer(PyzAntelope $antelopeEntity, AntelopeTransfer $antelopeTransfer): AntelopeTransfer;

    public function mapAntelopeTransferToAntelopeEntity(AntelopeTransfer $antelopeTransfer, PyzAntelope $antelopeEntity): PyzAntelope;

    public function mapAntelopeCollectionToAntelopeTransferCollection(ObjectCollection $antelopeEntities, AntelopeCollectionTransfer $antelopeCollectionTransfer): AntelopeCollectionTransfer;
}
