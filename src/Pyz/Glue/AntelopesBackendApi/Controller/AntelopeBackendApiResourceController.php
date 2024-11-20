<?php

namespace Pyz\Glue\AntelopesBackendApi\Controller;

use Generated\Shared\Transfer\AbstractProductsRestAttributesTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
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
}
