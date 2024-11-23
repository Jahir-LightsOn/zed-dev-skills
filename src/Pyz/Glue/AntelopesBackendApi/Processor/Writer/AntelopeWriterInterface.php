<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Writer;

use Generated\Shared\Transfer\AntelopesBackendApiAttributeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeWriterInterface
{
    public function createAntelope(AntelopesBackendApiAttributeTransfer $antelopeAttributeTransfer, GlueRequestTransfer $requestTransfer): GlueResponseTransfer;
}
