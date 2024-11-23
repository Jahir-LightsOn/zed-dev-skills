<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributeTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeUpdater implements AntelopeUpdaterInterface
{
    public function __construct(
        private readonly AntelopeFacadeInterface $antelopeFacade,
        private readonly AntelopeResponseBuilderInterface $antelopeResponseBuilder
    ) {
    }

    public function updateAntelope(AntelopesBackendApiAttributeTransfer $antelopeAttributeTransfer, GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
        $antelopeTransfer = (new AntelopeTransfer())->fromArray($antelopeAttributeTransfer->toArray(), true);
        $antelopeTransfer = $this->antelopeFacade->updateAntelope($antelopeTransfer);
        $antelopeCollection = (new AntelopeCollectionTransfer())->addAntelope($antelopeTransfer);
        return $this->antelopeResponseBuilder->createAntelopeResponse($antelopeCollection);
    }
}
