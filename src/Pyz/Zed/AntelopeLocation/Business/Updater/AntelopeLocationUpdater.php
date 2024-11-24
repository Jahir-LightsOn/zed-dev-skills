<?php

namespace Pyz\Zed\AntelopeLocation\Business\Updater;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface;

class AntelopeLocationUpdater implements AntelopeLocationUpdaterInterface
{
    public function __construct(
        protected AntelopeLocationEntityManagerInterface $antelopeLocationEntityManager
    ) {
    }

    /**
     * @param AntelopeLocationTransfer $antelopeLocationTransfer
     * @return AntelopeLocationTransfer
     */
    public function updateAntelope(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer {
        return $this->antelopeLocationEntityManager->updateAntelopeLocation($antelopeLocationTransfer);
    }
}
