<?php

namespace Pyz\Zed\AntelopeLocation\Business;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;

/**
 * @method  \Pyz\Zed\AntelopeLocation\Business\AntelopeLocationBusinessFactory getFactory()
 */
interface AntelopeLocationFacadeInterface
{
    /**
     * @param AntelopeLocationTransfer $antelopeLocationTransfer
     * @return AntelopeLocationTransfer
     */
    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer;

    /**
     * @param AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
     * @return AntelopeLocationResponseTransfer
     */
    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): AntelopeLocationResponseTransfer;

    /**
     * @param AntelopeLocationCriteriaTransfer $antelopeLocationCriteria
     * @return AntelopeLocationCollectionTransfer
     */
    public function getAntelopeLocationCollection(AntelopeLocationCriteriaTransfer $antelopeLocationCriteria): AntelopeLocationCollectionTransfer;


    /**
     * @param AntelopeLocationTransfer $antelopeLocationTransfer
     * @return AntelopeLocationTransfer
     */
    public function updateAntelope(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer;

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeTransfer);
}
