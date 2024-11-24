<?php

namespace Pyz\Zed\AntelopeLocation\Business\Deleter;

use Generated\Shared\Transfer\AntelopeLocationTransfer;

interface AntelopeLocationDeleterInterface
{
    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): bool;
}
