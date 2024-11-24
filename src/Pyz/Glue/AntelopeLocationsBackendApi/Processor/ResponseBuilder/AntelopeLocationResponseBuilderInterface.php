<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeLocationResponseBuilderInterface
{
    public function createAntelopeLocationResponse(AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer): GlueResponseTransfer;

    /**
     * @param mixed $antelopeLocation
     * @return GlueResourceTransfer
     */
    public function mapAntelopeLocationDtoToGlueResourceTransfer(AntelopeLocationTransfer $antelopeLocation): GlueResourceTransfer;

    /**
     * @param string $message
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function createAntelopeLocationSingleErrorResponse(string $message): GlueResponseTransfer;
}
