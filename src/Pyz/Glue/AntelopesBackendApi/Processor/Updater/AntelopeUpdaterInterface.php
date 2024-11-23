<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopesBackendApiAttributeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeUpdaterInterface
{
    public function updateAntelope(AntelopesBackendApiAttributeTransfer $antelopeAttributeTransfer, GlueRequestTransfer $requestTransfer): GlueResponseTransfer;

}
