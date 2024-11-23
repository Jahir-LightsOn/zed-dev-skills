<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Deleter;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeDeleter implements AntelopeDeleterInterface
{
    public function __construct(
        private readonly AntelopeFacadeInterface $antelopeFacade,
        private readonly AntelopeResponseBuilderInterface $antelopeResponseBuilder
    ) {
    }

    public function deleteAntelope(AntelopesBackendApiAttributeTransfer $antelopeAttributeTransfer, GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
        $isDeleted = $this->antelopeFacade->deleteAntelope($antelopeAttributeTransfer->getIdAntelope());
        if (!$isDeleted) {
            throw new \Exception('Failed to delete antelope');
        }
        return $this->antelopeResponseBuilder->createAntelopeResponse(new AntelopeCollectionTransfer());
    }
}
