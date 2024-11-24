<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributeTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig;

class AntelopeLocationResponseBuilder implements AntelopeLocationResponseBuilderInterface
{
    public function createAntelopeLocationResponse(AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer): GlueResponseTransfer
    {
        $responseTransfer = new GlueResponseTransfer();
        foreach ($antelopeLocationCollectionTransfer->getAntelopeLocations() as $antelopeLocation) {
            $resourceTransfer = $this->mapAntelopeLocationDtoToGlueResourceTransfer($antelopeLocation);
            $responseTransfer->addResource($resourceTransfer);
        }
        return $responseTransfer;
    }

    /**
     * @param mixed $antelopeLocation
     * @return GlueResourceTransfer
     */
    public function mapAntelopeLocationDtoToGlueResourceTransfer(AntelopeLocationTransfer $antelopeLocation): GlueResourceTransfer
    {
        $resourceTransfer = new GlueResourceTransfer();
        $resourceTransfer->setType(AntelopeLocationsBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS);
        $resourceTransfer->setId('' . $antelopeLocation->getIdAntelopeLocation());
        $resourceTransfer->setAttributes((new AntelopeLocationsBackendApiAttributeTransfer())->fromArray($antelopeLocation->toArray(), true));
        return $resourceTransfer;
    }
}
