<?php

namespace Pyz\Zed\AntelopeLocation\Business;

use Pyz\Zed\AntelopeLocation\Business\Deleter\AntelopeLocationDeleter;
use Pyz\Zed\AntelopeLocation\Business\Deleter\AntelopeLocationDeleterInterface;
use Pyz\Zed\AntelopeLocation\Business\Reader\AntelopeLocationReader;
use Pyz\Zed\AntelopeLocation\Business\Updater\AntelopeLocationUpdater;
use Pyz\Zed\AntelopeLocation\Business\Updater\AntelopeLocationUpdaterInterface;
use Pyz\Zed\AntelopeLocation\Business\Writer\AntelopeLocationWriter;
use Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface;
use Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationRepositoryInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method AntelopeLocationEntityManagerInterface getEntityManager()
 * @method AntelopeLocationRepositoryInterface getRepository()
 */
class AntelopeLocationBusinessFactory extends AbstractBusinessFactory
{

    public function createAntelopeLocationWriter(): AntelopeLocationWriter
    {
        return new AntelopeLocationWriter($this->getEntityManager());
    }

    public function createAntelopeLocationReader(): AntelopeLocationReader
    {
        return new AntelopeLocationReader($this->getRepository());
    }

    public function createAntelopeLocationUpdater(): AntelopeLocationUpdaterInterface
    {
        return new AntelopeLocationUpdater($this->getEntityManager());
    }

    public function createAntelopeLocationDeleter(): AntelopeLocationDeleterInterface
    {
        return new AntelopeLocationDeleter($this->getEntityManager());
    }
}
