<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeType\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\AntelopeType\Persistence\AntelopeTypePersistenceFactory getFactory()
 */
class AntelopeTypeRepository extends AbstractRepository implements AntelopeTypeRepositoryInterface
{
    /**
     * @return Generated\Shared\Transfer\AntelopeTypeCollectionTransfer
     */
    public function getAntelopeTypeCollection() : Generated\Shared\Transfer\AntelopeTypeCollectionTransfer
    {
    }
}
