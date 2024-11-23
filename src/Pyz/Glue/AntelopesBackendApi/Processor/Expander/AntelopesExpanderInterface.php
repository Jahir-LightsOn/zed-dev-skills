<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Expander;

use Generated\Shared\Transfer\AntelopeConditionTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;

interface AntelopesExpanderInterface
{
    public function expandWithFilters(AntelopeConditionTransfer $antelopeConditionTransfer, GlueRequestTransfer $glueRequestTransfer): AntelopeConditionTransfer;
}
