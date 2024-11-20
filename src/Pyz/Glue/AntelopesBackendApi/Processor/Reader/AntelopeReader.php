<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Reader;

use Generated\Shared\Transfer\AbstractProductsRestAttributesTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeReader implements AntelopeReaderInterface
{
    public function __construct(private readonly AntelopeFacadeInterface $facade, private readonly AntelopeResponseBuilderInterface $responseBuilder)
    {
    }

    public function getCollectionAction(GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
        $antelopeCollection = $this->facade->getAntelopeCollection(new AntelopeCriteriaTransfer());
        return $this->responseBuilder->createAntelopeResponse($antelopeCollection);
    }
}
