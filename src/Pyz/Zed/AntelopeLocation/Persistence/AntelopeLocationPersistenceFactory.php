<?php declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Persistence;


use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Pyz\Zed\AntelopeLocation\Persistence\Mapper\AntelopeLocationMapper;
use Pyz\Zed\AntelopeLocation\Persistence\Mapper\AntelopeLocationMapperInterface;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class AntelopeLocationPersistenceFactory extends AbstractPersistenceFactory
{
    public function createAntelopeLocationQuery(): PyzAntelopeLocationQuery
    {
        return PyzAntelopeLocationQuery::create();
    }

    public function createAntelopeLocationMapper(): AntelopeLocationMapperInterface
    {
        return new AntelopeLocationMapper();
    }
}
