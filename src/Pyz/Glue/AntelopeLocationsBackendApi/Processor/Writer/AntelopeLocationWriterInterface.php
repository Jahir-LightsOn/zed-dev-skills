<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Writer;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeLocationWriterInterface
{
    public function createAntelopeLocation(AntelopeLocationsBackendApiAttributeTransfer $antelopeLocationsBackendApiAttributeTransfer, GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer;
}
