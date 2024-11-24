<?php

namespace Pyz\Zed\AntelopeLocation\Persistence\Mapper;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\AntelopeLocation\Persistence\Base\PyzAntelopeLocation;
use Propel\Runtime\Collection\ObjectCollection;

interface AntelopeLocationMapperInterface
{
    /**
     * @param PyzAntelopeLocation $antelopeLocationEntity
     * @param AntelopeLocationTransfer $antelopeLocationTransfer
     * @return AntelopeLocationTransfer
     */
    public function mapAntelopeLocationEntityToAntelopeLocationTransfer(PyzAntelopeLocation $antelopeLocationEntity, AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer;

    /**
     * @param AntelopeLocationTransfer $antelopeLocationTransfer
     * @param PyzAntelopeLocation $antelopeLocationEntity
     * @return PyzAntelopeLocation
     */
    public function mapAntelopeLocationTransferToAntelopeLocationEntity(AntelopeLocationTransfer $antelopeLocationTransfer, PyzAntelopeLocation $antelopeLocationEntity): PyzAntelopeLocation;

    /**
     * @param ObjectCollection $antelopeLocationEntities
     * @param AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer
     * @return AntelopeLocationCollectionTransfer
     */
    public function mapAntelopeLocationEntityCollectionToAntelopeLocationTransferCollection(ObjectCollection $antelopeLocationEntities, AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer): AntelopeLocationCollectionTransfer;
}
