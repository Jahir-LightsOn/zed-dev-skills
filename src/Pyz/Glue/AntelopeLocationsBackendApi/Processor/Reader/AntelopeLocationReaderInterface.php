<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeLocationReaderInterface
{
    /**
     * @param GlueRequestTransfer $glueRequestTransfer
     * @return GlueResponseTransfer
     */
    public function getAntelopeLocationCollection(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer;

    /**
     * @param GlueRequestTransfer $requestTransfer
     * @return GlueResponseTransfer
     */
    public function getAntelopeLocation(GlueRequestTransfer $requestTransfer): GlueResponseTransfer;
}
