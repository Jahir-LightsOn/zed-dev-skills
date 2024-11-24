<?php

namespace Pyz\Zed\AntelopeLocation\Business\Deleter;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface;

class AntelopeLocationDeleter implements AntelopeLocationDeleterInterface
{
    public function __construct(
        protected readonly AntelopeLocationEntityManagerInterface $antelopeEntityManager
    ) {
    }

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): bool
    {
        return $this->antelopeEntityManager->deleteAntelopeLocation($antelopeLocationTransfer);
    }
}
