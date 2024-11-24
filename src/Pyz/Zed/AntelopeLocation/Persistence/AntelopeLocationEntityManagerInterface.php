<?php

namespace Pyz\Zed\AntelopeLocation\Persistence;

use Generated\Shared\Transfer\AntelopeLocationTransfer;

interface AntelopeLocationEntityManagerInterface
{
    /**
     * @param AntelopeLocationTransfer $antelopeLocationTransfer
     * @return AntelopeLocationTransfer
     */
    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer;

    /**
     * @param AntelopeLocationTransfer $antelopeLocationTransfer
     * @return AntelopeLocationTransfer
     */
    public function updateAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer;

    /**
     * @param AntelopeLocationTransfer $antelopeLocationTransfer
     * @return bool
     */
    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): bool;
}
