<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeType\Persistence;

use Generated\Shared\Transfer\AntelopeTypeCollectionTransfer;

interface AntelopeTypeRepositoryInterface
{
    /**
     * @return \Pyz\Zed\AntelopeType\Persistence\Generated\Shared\Transfer\AntelopeTypeCollectionTransfer
     */
    public function getAntelopeTypeCollection(): AntelopeTypeCollectionTransfer;
}
