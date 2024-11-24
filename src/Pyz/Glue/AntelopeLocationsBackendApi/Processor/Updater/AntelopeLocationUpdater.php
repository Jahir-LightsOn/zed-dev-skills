<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributeTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;

class AntelopeLocationUpdater implements AntelopeLocationUpdaterInterface
{
    public function __construct(
        private readonly AntelopeLocationFacadeInterface $antelopeLocationFacade,
        private readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder
    ) {
    }

    public function updateAntelopeLocation(AntelopeLocationsBackendApiAttributeTransfer $antelopeLocationAttributeTransfer, GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())->fromArray($antelopeLocationAttributeTransfer->toArray(), true);
        $antelopeLocationTransfer = $this->antelopeLocationFacade->updateAntelope($antelopeLocationTransfer);
        $antelopeCollection = (new AntelopeLocationCollectionTransfer())->addAntelopeLocation($antelopeLocationTransfer);
        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse($antelopeCollection);
    }
}
