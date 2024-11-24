<?php

namespace Pyz\Zed\AntelopeLocation\Business\Reader;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationRepositoryInterface;

class AntelopeLocationReader
{
    public function __construct(
        protected AntelopeLocationRepositoryInterface $antelopeLocationRepository
    ) {
    }

    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): AntelopeLocationResponseTransfer {
        /*$antelopeLocationTransfer = $this->antelopeLocationRepository->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);
        $antelopeLocationResponseTransfer = new AntelopeLocationResponseTransfer();
        $antelopeLocationResponseTransfer->setIsSuccessFul(false);
        if ($antelopeLocationTransfer) {
            $antelopeLocationResponseTransfer->setAntelopeLocation($antelopeLocationTransfer);
            $antelopeLocationResponseTransfer->setIsSuccessFul(true);
        }
        return $antelopeLocationResponseTransfer;*/
        return new AntelopeLocationResponseTransfer();
    }

    public function getAntelopeLocationCollection(AntelopeLocationCriteriaTransfer $antelopeLocationCriteria): AntelopeLocationCollectionTransfer
    {
        return $this->antelopeLocationRepository->getAntelopeLocationCollection($antelopeLocationCriteria);
    }
}
