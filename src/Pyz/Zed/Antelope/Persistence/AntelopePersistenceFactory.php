<?php
declare(strict_types=1);
namespace Pyz\Zed\Antelope\Persistence;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Pyz\Zed\Antelope\Persistence\Mapper\AntelopeMapper;
use Pyz\Zed\Antelope\Persistence\Mapper\AntelopeMapperInterface;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class AntelopePersistenceFactory extends AbstractPersistenceFactory
{
    public function createAntelopeQuery(): PyzAntelopeQuery
    {
        return PyzAntelopeQuery::create();
    }

    public function createAntelopeLocationQuery(): PyzAntelopeLocationQuery
    {
        return PyzAntelopeLocationQuery::create();
    }

    public function createAntelopeMapper(): AntelopeMapperInterface
    {
        return new AntelopeMapper();
    }
}
