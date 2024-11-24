<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributeTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig;
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
        if ($antelopeLocationTransfer->getIdAntelopeLocation() === null || $antelopeLocationTransfer->getLocationName() === null) {
            return $this->antelopeLocationResponseBuilder->createAntelopeLocationSingleErrorResponse(AntelopeLocationsBackendApiConfig::VALIDATION_WRONG_REQUEST_BODY);
        }

        $antelopeLocationTransfer = $this->antelopeLocationFacade->updateAntelope($antelopeLocationTransfer);
        if ($antelopeLocationTransfer->getIdAntelopeLocation() === null) {
            return $this->antelopeLocationResponseBuilder->createAntelopeLocationSingleErrorResponse(AntelopeLocationsBackendApiConfig::ANTELOPE_LOCATION_NOT_UPDATED);
        }
        $antelopeCollection = (new AntelopeLocationCollectionTransfer())->addAntelopeLocation($antelopeLocationTransfer);
        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse($antelopeCollection);
    }
}
