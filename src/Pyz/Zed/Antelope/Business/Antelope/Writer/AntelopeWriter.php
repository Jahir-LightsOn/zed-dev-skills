<?php

namespace Pyz\Zed\Antelope\Business\Antelope\Writer;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

class AntelopeWriter
{
    public function __construct(
        protected AntelopeEntityManagerInterface $entityManager
    ) {
    }

    public function createAntelope(AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        return $this->entityManager->createAntelope($antelopeTransfer);
    }

    public function updateAntelope(AntelopeTransfer $antelopeTransfer)
    {
        return $this->entityManager->updateAntelope($antelopeTransfer);
    }

    public function deleteAntelope(int $antelopeId): bool
    {
        return $this->entityManager->deleteAntelope($antelopeId);
    }
}
