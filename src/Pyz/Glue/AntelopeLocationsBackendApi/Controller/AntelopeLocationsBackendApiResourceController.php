<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Controller;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Spryker\Glue\Kernel\Backend\Controller\AbstractController;

/**
 * @method \Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiFactory getFactory()
 */
class AntelopeLocationsBackendApiResourceController extends AbstractController
{
    public function getCollectionAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        return $this->getFactory()
            ->createAntelopeLocationReader()
            ->getAntelopeLocationCollection($glueRequestTransfer);
    }

    public function getAction(GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocation($requestTransfer);
    }

    public function postAction(
        AntelopeLocationsBackendApiAttributeTransfer $antelopeLocationAttributeTransfer,
        GlueRequestTransfer $requestTransfer
    ): GlueResponseTransfer {
        return $this->getFactory()->createAntelopeLocationWriter()->createAntelopeLocation($antelopeLocationAttributeTransfer, $requestTransfer);
    }

    public function patchAction(
        AntelopeLocationsBackendApiAttributeTransfer $antelopeLocationAttributeTransfer,
        GlueRequestTransfer $requestTransfer
    ): GlueResponseTransfer {
        $antelopeLocationAttributeTransfer->setIdAntelopeLocation((int)$requestTransfer->getResource()->getId());
        return $this->getFactory()->createAntelopeLocationUpdater()->updateAntelopeLocation($antelopeLocationAttributeTransfer, $requestTransfer);
    }

    public function deleteAction(GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        return $this->getFactory()->createAntelopeLocationDeleter()->deleteAntelopeLocation($glueRequestTransfer);
    }


}
