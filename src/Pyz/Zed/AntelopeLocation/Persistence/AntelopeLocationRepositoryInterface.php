<?php

namespace Pyz\Zed\AntelopeLocation\Persistence;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;

/**
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationPersistenceFactory getFactory()
 */
interface AntelopeLocationRepositoryInterface
{
    /**
     * @param AntelopeLocationCriteriaTransfer $antelopeLocationCriteria
     * @return AntelopeLocationCollectionTransfer
     */
    public function getAntelopeLocationCollection(AntelopeLocationCriteriaTransfer $antelopeLocationCriteria): AntelopeLocationCollectionTransfer;
}
