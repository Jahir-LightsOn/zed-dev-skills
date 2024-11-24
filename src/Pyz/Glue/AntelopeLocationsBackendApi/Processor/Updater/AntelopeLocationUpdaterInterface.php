<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeLocationUpdaterInterface
{
    public function updateAntelopeLocation(AntelopeLocationsBackendApiAttributeTransfer $antelopeLocationAttributeTransfer, GlueRequestTransfer $requestTransfer): GlueResponseTransfer;
}
