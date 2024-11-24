<?php

namespace Pyz\Zed\AntelopeLocation\Business;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method  \Pyz\Zed\AntelopeLocation\Business\AntelopeLocationBusinessFactory getFactory()
 */
class AntelopeLocationFacade extends AbstractFacade implements AntelopeLocationFacadeInterface
{
    /**
     * @param AntelopeLocationTransfer $antelopeLocationTransfer
     * @return AntelopeLocationTransfer
     */
    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        return $this->getFactory()->createAntelopeLocationWriter()->createAntelopeLocation($antelopeLocationTransfer);
    }

    /**
     * @param AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
     * @return AntelopeLocationResponseTransfer
     */
    public function getAntelopeLocation(
        AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): AntelopeLocationResponseTransfer {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocation($antelopeLocationCriteriaTransfer);
    }

    /**
     * @param AntelopeLocationCriteriaTransfer $antelopeLocationCriteria
     * @return AntelopeLocationCollectionTransfer
     */
    public function getAntelopeLocationCollection(AntelopeLocationCriteriaTransfer $antelopeLocationCriteria): AntelopeLocationCollectionTransfer
    {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocationCollection($antelopeLocationCriteria);
    }

    public function updateAntelope(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        return $this->getFactory()->createAntelopeLocationUpdater()->updateAntelope($antelopeLocationTransfer);
    }

    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer)
    {
       return $this->getFactory()->createAntelopeLocationDeleter()->deleteAntelopeLocation($antelopeLocationTransfer);
    }
}
