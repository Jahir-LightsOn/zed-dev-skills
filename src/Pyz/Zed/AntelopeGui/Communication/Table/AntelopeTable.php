<?php

namespace Pyz\Zed\AntelopeGui\Communication\Table;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Propel\Runtime\Collection\ObjectCollection;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeTable extends AbstractTable
{
    public const COL_ID_ANTELOPE = 'id_antelope';
    public const COL_NAME = 'name';
    public const COL_LOCATION_NAME = 'location_name';

    protected $antelopeQuery;
    private AntelopeFacadeInterface $antelopeFacade;

    public function __construct(PyzAntelopeQuery $antelopeQuery, AntelopeFacadeInterface $antelopeFacade)
    {
        $this->antelopeQuery = $antelopeQuery;
        $this->antelopeFacade = $antelopeFacade;
    }

    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([
            static::COL_ID_ANTELOPE => 'Antelope ID',
            static::COL_NAME => 'Name',
            static::COL_LOCATION_NAME => 'Location Name',
        ]);

        $config->setSortable([
            static::COL_ID_ANTELOPE,
            static::COL_NAME,
        ]);

        $config->setSearchable([
            PyzAntelopeTableMap::COL_NAME,
        ]);

        return $config;
    }

    protected function prepareData(TableConfiguration $config)
    {

        $antelopeEntityCollection = $this->runQuery(
            $this->antelopeQuery,
            $config,
            true
        );

        if (!$antelopeEntityCollection->count()) {
            return [];
        }

        return $this->mapReturns($antelopeEntityCollection);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Antelope\Persistence\PyzAntelope> $antelopeEntityCollection
     *
     * @return array
     */
    protected function mapReturns(ObjectCollection $antelopeEntityCollection): array
    {
        $returns = [];

        foreach ($antelopeEntityCollection as $antelopeEntity) {
            $locationName = "";
            if ($antelopeEntity->getFkAntelopeLocation()) {
                $antelopeLocationResponseTransfer = $this->antelopeFacade->getAntelopeLocation(
                    (new AntelopeLocationCriteriaTransfer())->setIdAntelopeLocation($antelopeEntity->getFkAntelopeLocation()));
                if ($antelopeLocationResponseTransfer) {
                    $locationName = $antelopeLocationResponseTransfer->getAntelopeLocation()->getLocationName();
                }
            }
            $returns[] = [
                static::COL_ID_ANTELOPE => $antelopeEntity->getIdAntelope(),
                static::COL_NAME => $antelopeEntity->getName(),
                static::COL_LOCATION_NAME => $locationName,
            ];
        }

        return $returns;
    }
}
