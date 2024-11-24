<?php

namespace Pyz\Zed\AntelopeLocation\Persistence;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\ErrorTransfer;
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
        try {
            $antelopeLocationEntity->save();
        } catch (\Exception $e) {
            return $antelopeLocationTransfer->setErrors((new \ArrayObject([(new ErrorTransfer())])));
        }
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
            return $antelopeLocationTransfer->setErrors((new \ArrayObject([(new ErrorTransfer())])));
        }
        $antelopeLocationEntity->fromArray($antelopeLocationTransfer->toArray());

        try {
            $antelopeLocationEntity->save();
        } catch (\Exception $e) {
            $antelopeLocationTransfer->setIdAntelopeLocation(null);
            return $antelopeLocationTransfer->setErrors((new \ArrayObject([(new ErrorTransfer())])));
        }

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
