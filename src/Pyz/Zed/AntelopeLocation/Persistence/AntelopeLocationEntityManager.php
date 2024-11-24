<?php

namespace Pyz\Zed\AntelopeLocation\Persistence;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocation;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationPersistenceFactory getFactory()
 */
class AntelopeLocationEntityManager extends AbstractEntityManager implements
    AntelopeLocationEntityManagerInterface
{
    /**
     * @inheritdoc
     */
    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        $antelopeLocationEntity = new PyzAntelopeLocation();
        $antelopeLocationEntity->fromArray($antelopeLocationTransfer->modifiedToArray());
        $antelopeLocationEntity->save();
        return $antelopeLocationTransfer->fromArray($antelopeLocationEntity->toArray(), true);

    }

    /**
     * @inheritdoc
     */
    public function updateAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        $antelopeLocationEntity = $this->getFactory()->createAntelopeLocationQuery()
            ->filterByIdAntelopeLocation($antelopeLocationTransfer->getIdAntelopeLocation())->findOne();

        if (!$antelopeLocationEntity) {
            return $antelopeLocationTransfer;
        }
        $antelopeLocationEntity->fromArray($antelopeLocationTransfer->toArray());

        $antelopeLocationEntity->save();

        return $antelopeLocationTransfer->fromArray($antelopeLocationEntity->toArray(), true);
    }

    /**
     * @inheritdoc
     */
    public function deleteAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): bool
    {
        $antelopeLocationEntity = $this->getFactory()->createAntelopeLocationQuery()
            ->filterByIdAntelopeLocation($antelopeLocationTransfer->getIdAntelopeLocation())->findOne();
        if (!$antelopeLocationEntity) {
            return false;
        }
        $antelopeLocationEntity->delete();
        return $antelopeLocationEntity->isDeleted();
    }

}
