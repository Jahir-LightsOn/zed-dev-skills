<?php

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationResponseTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
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

    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteria): AntelopeCollectionTransfer
    {
        $antelopeCollectionQuery = $this->getFactory()->createAntelopeQuery();
        $antelopeCollectionQuery->joinWithPyzAntelopeLocation()
            ->joinWithPyzAntelopeType();
        $antelopeCollectionTransfer = new AntelopeCollectionTransfer();
        $paginationTransfer = $antelopeCriteria->getPagination();
        $this->applySearch($antelopeCriteria, $antelopeCollectionQuery);
        $this->applySorting($antelopeCriteria, $antelopeCollectionQuery);
        if ($paginationTransfer) {
            $this->applyPagination($paginationTransfer, $antelopeCollectionQuery);
        }
        $antelopeCollectionTransfer->setPagination($paginationTransfer);

        $antelopeCollection = $antelopeCollectionQuery->find();

        return $this->getFactory()
            ->createAntelopeMapper()
            ->mapAntelopeCollectionToAntelopeTransferCollection($antelopeCollection, $antelopeCollectionTransfer);
    }

    private function applyPagination(PaginationTransfer $paginationTransfer, PyzAntelopeQuery $antelopeCollectionQuery): void
    {
        if ($paginationTransfer->getOffset() != null && $paginationTransfer->getLimit() > 0) {
            $paginationTransfer->setNbResults($antelopeCollectionQuery->count());
            $antelopeCollectionQuery->limit($paginationTransfer->getLimit())
                ->offset($paginationTransfer->getOffset());
            return;
        }
        if ($paginationTransfer->getPage() != null && $paginationTransfer->getMaxPerPage() != null) {
            $pager = $antelopeCollectionQuery->paginate($paginationTransfer->getPage(), $paginationTransfer->getMaxPerPage());
            $paginationTransfer->setNbResults($pager->getNbResults())
                ->setFirstIndex($pager->getFirstIndex())
                ->setLastIndex($pager->getLastIndex())
                ->setFirstPage($pager->getFirstPage())
                ->setLastPage($pager->getLastPage())
                ->setNextPage($pager->getNextPage())
                ->setPreviousPage($pager->getPreviousPage());
        }

    }

    private function applySearch(AntelopeCriteriaTransfer $antelopeCriteria, PyzAntelopeQuery $antelopeCollectionQuery): void
    {
        $antelopeConditions = $antelopeCriteria->getAntelopeConditions();
        if (!$antelopeConditions) {
            return;
        }
        if ($idAntelope = $antelopeConditions->getIdAntelope()) {
            $antelopeCollectionQuery->_or()->filterByIdAntelope($idAntelope);
        }
        if ($name = $antelopeConditions->getName()) {
            $likePattern = '%' . $name . '%';
            $antelopeCollectionQuery->_or()->filterByName_Like($likePattern);
        }
        if ($antelopesIds = $antelopeConditions->getAntelopeIds()) {
            $antelopeCollectionQuery->_or()->filterByIdAntelope_In($antelopesIds);
        }
        if ($idLocation = $antelopeConditions->getLocationId()) {
            $antelopeCollectionQuery->_or()->filterByFkAntelopeLocation($idLocation);
        }
        if ($idType = $antelopeConditions->getTypeId()) {
            $antelopeCollectionQuery->_or()->filterByFkAntelopeType($idType);
        }
    }

    private function applySorting(AntelopeCriteriaTransfer $antelopeCriteria, PyzAntelopeQuery $antelopeCollectionQuery): void
    {
        foreach ($antelopeCriteria->getSortCollection() as $sortTransfer) {
            $columnName = $sortTransfer->getField();
            $order = $sortTransfer->getIsAscending() ? 'ASC' : 'DESC';
            $antelopeCollectionQuery->orderBy($columnName, $order);
        }
    }
}
