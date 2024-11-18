<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements
    AntelopeRepositoryInterface
{
 public function getAntelope(AntelopeCriteriaTransfer $antelopeCriteriaTransfer):?AntelopeTransfer
 {
     $antelopeEntity = $this->getFactory()->createAntelopeQuery()->filterByName(
         $antelopeCriteriaTransfer->getName(),
     )->findOne();
     if(!$antelopeEntity){
         return null;
     }
     return (new AntelopeTransfer())->fromArray($antelopeEntity->toArray(), true);
 }

    public function getAntelopeLocation(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer): ?AntelopeLocationTransfer
    {
        $antelopeLocationQuery= $this->getFactory()->createAntelopeLocationQuery();

        if ($antelopeLocationCriteriaTransfer->getIdAntelopeLocation() !== null) {
            $antelopeLocationQuery = $antelopeLocationQuery->filterByIdAntelopeLocation($antelopeLocationCriteriaTransfer->getIdAntelopeLocation());
        } elseif ($antelopeLocationCriteriaTransfer->getLocationName() !== null) {
            $antelopeLocationQuery = $antelopeLocationQuery->filterByLocationName($antelopeLocationCriteriaTransfer->getLocationName());
        } else {
            return null;
        }

        $antelopeLocationEntity = $antelopeLocationQuery->findOne();

        if (!$antelopeLocationEntity) {
            return null;
        }
        return (new AntelopeLocationTransfer())->fromArray($antelopeLocationEntity->toArray(), true);
    }

    public function getAntelopeLocationCollection(): array
    {
        $antelopeLocationCollection = $this->getFactory()->createAntelopeLocationQuery()->find();
        $antelopeLocationResponseTransferCollection = [];
        foreach ($antelopeLocationCollection as $antelopeLocationEntity) {
            $antelopeLocationResponseTransfer = new AntelopeLocationResponseTransfer();
            $antelopeLocationResponseTransfer->setAntelopeLocation(
                (new AntelopeLocationTransfer())->fromArray($antelopeLocationEntity->toArray(), true));
            $antelopeLocationResponseTransferCollection[] = $antelopeLocationResponseTransfer;
        }
        return $antelopeLocationResponseTransferCollection;
    }
}
