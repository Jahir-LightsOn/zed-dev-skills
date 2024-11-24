<?php

namespace Pyz\Zed\AntelopeLocation\Business\Updater;

use Generated\Shared\Transfer\AntelopeLocationTransfer;

interface AntelopeLocationUpdaterInterface
{
    /**
     * @param AntelopeLocationTransfer $antelopeLocationTransfer
     * @return AntelopeLocationTransfer
     */
    public function updateAntelope(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer;
}
