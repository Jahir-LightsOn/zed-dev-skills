<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Deleter;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;

class AntelopeLocationDeleter implements AntelopeLocationDeleterInterface
{

    public function __construct(
        protected readonly AntelopeLocationFacadeInterface $antelopeLocationFacade,
        protected readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder,
    ) {
    }

    public function deleteAntelopeLocation(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer {
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())->setIdAntelopeLocation((int)$glueRequestTransfer->getResource()?->getId());
        $this->antelopeLocationFacade->deleteAntelopeLocation($antelopeLocationTransfer);
        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse(new AntelopeLocationCollectionTransfer());
    }
}
