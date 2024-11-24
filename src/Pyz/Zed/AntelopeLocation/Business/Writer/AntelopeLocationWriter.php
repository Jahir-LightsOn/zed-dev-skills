<?php

namespace Pyz\Zed\AntelopeLocation\Business\Writer;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface;

class AntelopeLocationWriter
{
    public function __construct(
        protected AntelopeLocationEntityManagerInterface $antelopeLocationEntityManager
    ) {
    }

    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer {
        return $this->antelopeLocationEntityManager->createAntelopeLocation($antelopeLocationTransfer);
    }
}
