<?php

namespace Pyz\Zed\AntelopeLocation\Persistence;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationPersistenceFactory getFactory()
 */
class AntelopeLocationRepository extends AbstractRepository implements
    AntelopeLocationRepositoryInterface
{
    public function getAntelopeLocationCollection(AntelopeLocationCriteriaTransfer $antelopeLocationCriteria): AntelopeLocationCollectionTransfer
    {
        $antelopeLocationQuery = $this->getFactory()->createAntelopeLocationQuery();
        $antelopeLocationCollection = new AntelopeLocationCollectionTransfer();
        $paginationTransfer = $antelopeLocationCriteria->getPagination();
        $this->applySearch($antelopeLocationQuery, $antelopeLocationCriteria);
        $this->applySorting($antelopeLocationQuery, $antelopeLocationCriteria);
        if ($paginationTransfer) {
            $this->applyPagination($antelopeLocationQuery, $paginationTransfer);
        }
        $antelopeLocationEntityCollection = $antelopeLocationQuery->find();
        if ($antelopeLocationEntityCollection->count() === 0) {
            return $antelopeLocationCollection->setErrors(
                new \ArrayObject((new ErrorTransfer())->setMessage('No antelope location found'))
            );
        }
        return $this->getFactory()->createAntelopeLocationMapper()
            ->mapAntelopeLocationEntityCollectionToAntelopeLocationTransferCollection($antelopeLocationEntityCollection, $antelopeLocationCollection);
    }

    private function applyPagination(PyzAntelopeLocationQuery $antelopeLocationQuery, PaginationTransfer $paginationTransfer): void
    {
        if ($paginationTransfer->getOffset() !== null && $paginationTransfer->getLimit() > 0) {
            $antelopeLocationQuery->setNbResults($antelopeLocationQuery->count());
            $antelopeLocationQuery->setOffset($paginationTransfer->getOffset())
                ->setLimit($paginationTransfer->getLimit());
            return;
        }

        if ($paginationTransfer->getPage() != null && $paginationTransfer->getMaxPerPage() != null) {
            $pager = $antelopeLocationQuery->paginate($paginationTransfer->getPage(), $paginationTransfer->getMaxPerPage());
            $paginationTransfer->setNbResults($pager->getNbResults())
                ->setFirstIndex($pager->getFirstIndex())
                ->setLastIndex($pager->getLastIndex())
                ->setFirstPage($pager->getFirstPage())
                ->setLastPage($pager->getLastPage())
                ->setNextPage($pager->getNextPage())
                ->setPreviousPage($pager->getPreviousPage())
                ->setPage($pager->getPage())
                ->setMaxPerPage($pager->getMaxPerPage());
        }
    }

    private function applySearch(PyzAntelopeLocationQuery $antelopeLocationQuery, AntelopeLocationCriteriaTransfer $antelopeLocationCriteria): void
    {
        $antelopeLocationCondition = $antelopeLocationCriteria->getAntelopeLocationConditions();
        if (!$antelopeLocationCondition) {
            return;
        }
        if ($idAntelopeLocation = $antelopeLocationCondition->getIdAntelopeLocation()) {
            $antelopeLocationQuery->_or()->filterByIdAntelopeLocation($idAntelopeLocation);
        }
        if ($locationName = $antelopeLocationCondition->getLocationName()) {
            $antelopeLocationQuery->_or()->filterByLocationName($locationName);
        }
        if ($idsAntelopeLocation = $antelopeLocationCondition->getAntelopeLocationIds()) {
            $antelopeLocationQuery->_or()->filterByIdAntelopeLocation_In($idsAntelopeLocation);
        }

    }

    private function applySorting(PyzAntelopeLocationQuery $antelopeLocationQuery, AntelopeLocationCriteriaTransfer $antelopeLocationCriteria): void
    {
        foreach ($antelopeLocationCriteria->getSortCollection() as $sortTransfer) {
            $columnName = $sortTransfer->getField();
            $order = $sortTransfer->getIsAscending() ? 'ASC' : 'DESC';
            $antelopeLocationQuery->orderBy($columnName, $order);
        }
    }
}
