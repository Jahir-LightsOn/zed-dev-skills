<?php

namespace Pyz\Zed\AntelopeLocationGui\Communication\Table;

use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeLocationTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeLocationTable extends AbstractTable
{
    public const COL_ID_ANTELOPE_LOCATION = 'id_antelope_location';
    public const COL_LOCATION_NAME = 'location_name';

    protected $antelopeLocationQuery;

    public function __construct(PyzAntelopeLocationQuery $antelopeLocationQuery)
    {
        $this->antelopeLocationQuery = $antelopeLocationQuery;
    }

    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([
            static::COL_ID_ANTELOPE_LOCATION => 'Antelope Location ID',
            static::COL_LOCATION_NAME => 'Location Name',
        ]);

        $config->setSortable([
            static::COL_ID_ANTELOPE_LOCATION,
            static::COL_LOCATION_NAME,
        ]);

        $config->setSearchable([
            PyzAntelopeLocationTableMap::COL_LOCATION_NAME,
        ]);

        return $config;
    }

    protected function prepareData(TableConfiguration $config)
    {

        $antelopeLocationEntityCollection = $this->runQuery(
            $this->antelopeLocationQuery,
            $config,
            true
        );

        if (!$antelopeLocationEntityCollection->count()) {
            return [];
        }

        return $this->mapReturns($antelopeLocationEntityCollection);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Antelope\Persistence\PyzAntelopeLocation> $antelopeLocationEntityCollection
     *
     * @return array
     */
    protected function mapReturns(ObjectCollection $antelopeLocationEntityCollection): array
    {
        $returns = [];

        foreach ($antelopeLocationEntityCollection as $antelopeLocationEntity) {
            $returns[] = $antelopeLocationEntity->toArray();
        }

        return $returns;
    }
}
