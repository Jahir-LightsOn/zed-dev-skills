<?php

namespace Pyz\Glue\AntelopesBackendApi\Controller;

use Generated\Shared\Transfer\AbstractProductsRestAttributesTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;
use Spryker\Glue\Kernel\Backend\Controller\AbstractController;

/**
 * @method \Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiFactory getFactory()
 */
class AntelopeBackendApiResourceController extends AbstractController
{
    public function getCollectionAction(GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
        return $this->getFactory()->createAntelopeReader()->getCollectionAction($requestTransfer);
    }

    public function getAction(GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
        return $this->getFactory()->createAntelopeReader()->getAntelope($requestTransfer);
    }

    public function postAction(
        AntelopesBackendApiAttributeTransfer $antelopeAttributeTransfer,
        GlueRequestTransfer $requestTransfer
    ): GlueResponseTransfer {
        return $this->getFactory()->createAntelopeWriter()->createAntelope($antelopeAttributeTransfer, $requestTransfer);
    }

    public function patchAction(
        AntelopesBackendApiAttributeTransfer $antelopeAttributeTransfer,
        GlueRequestTransfer $requestTransfer
    ): GlueResponseTransfer {
        $antelopeAttributeTransfer->setIdAntelope((int)$requestTransfer->getResource()->getId());
        return $this->getFactory()->createAntelopeUpdater()->updateAntelope($antelopeAttributeTransfer, $requestTransfer);
    }

    public function deleteAction(
        AntelopesBackendApiAttributeTransfer $antelopeAttributeTransfer,
        GlueRequestTransfer $requestTransfer
    ): GlueResponseTransfer {
        $antelopeAttributeTransfer->setIdAntelope((int)$requestTransfer->getResource()->getId());
        return $this->getFactory()->createAntelopeDeleter()->deleteAntelope($antelopeAttributeTransfer, $requestTransfer);
    }
}
