<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AbstractProductsRestAttributesTransfer;
use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;

class AntelopeResponseBuilder implements AntelopeResponseBuilderInterface
{

    public function createAntelopeResponse(AntelopeCollectionTransfer $antelopeCollectionTransfer): GlueResponseTransfer
    {
        $responseTransfer = new GlueResponseTransfer();
        foreach ($antelopeCollectionTransfer->getAntelopes() as $antelope) {
            $resourceTransfer = $this->mapAntelopeDtoToGlueResourceTransfer($antelope);
            $responseTransfer->addResource($resourceTransfer);
        }
        return $responseTransfer;
    }

    /**
     * @param mixed $antelope
     * @return GlueResourceTransfer
     */
    public function mapAntelopeDtoToGlueResourceTransfer(AntelopeTransfer $antelope): GlueResourceTransfer
    {
        $resourceTransfer = new GlueResourceTransfer();
        $resourceTransfer->setType(AntelopesBackendApiConfig::RESOURCE_ANTELOPES);
        $resourceTransfer->setId('' . $antelope->getIdAntelope());
        $resourceTransfer->setAttributes((new AbstractProductsRestAttributesTransfer())->fromArray($antelope->toArray(), true));
        return $resourceTransfer;
    }
}
