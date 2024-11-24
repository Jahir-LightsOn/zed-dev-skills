<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Writer;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributeTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;

class AntelopeLocationWriter implements AntelopeLocationWriterInterface
{
    public function __construct(
        private readonly AntelopeLocationFacadeInterface $antelopeLocationFacade,
        private readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder
    ){
    }

    public function createAntelopeLocation(AntelopeLocationsBackendApiAttributeTransfer $antelopeLocationsBackendApiAttributeTransfer, GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationTransfer = (new AntelopeLocationTransfer())->fromArray($antelopeLocationsBackendApiAttributeTransfer->toArray(), true);
        $antelopeLocationTransfer = $this->antelopeLocationFacade->createAntelopeLocation($antelopeLocationTransfer);
        $antelopeLocationCollection = (new AntelopeLocationCollectionTransfer())->addAntelopeLocation($antelopeLocationTransfer);
        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse($antelopeLocationCollection);
    }
}
