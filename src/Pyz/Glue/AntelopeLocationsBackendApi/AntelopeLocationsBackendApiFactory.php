<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi;

use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Deleter\AntelopeLocationDeleter;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Deleter\AntelopeLocationDeleterInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader\AntelopeLocationReader;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader\AntelopeLocationReaderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilder;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater\AntelopeLocationUpdater;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Updater\AntelopeLocationUpdaterInterface;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Writer\AntelopeLocationWriter;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\Writer\AntelopeLocationWriterInterface;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractFactory;

/**
 * @method \Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig getConfig()
 */
class AntelopeLocationsBackendApiFactory extends AbstractFactory
{
    public function getAntelopeLocationFacade(): AntelopeLocationFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeLocationsBackendApiDependencyProvider::FACADE_ANTELOPE_LOCATION);
    }

    public function createAntelopeLocationReader(): AntelopeLocationReaderInterface
    {
        return new AntelopeLocationReader($this->getAntelopeLocationFacade(), $this->createAntelopeLocationResourceBuilder());
    }

    public function createAntelopeLocationResourceBuilder(): AntelopeLocationResponseBuilderInterface
    {
        return new AntelopeLocationResponseBuilder($this->getConfig());
    }

    public function createAntelopeLocationWriter(): AntelopeLocationWriterInterface
    {
        return new AntelopeLocationWriter($this->getAntelopeLocationFacade(), $this->createAntelopeLocationResourceBuilder());
    }

    public function createAntelopeLocationUpdater(): AntelopeLocationUpdaterInterface
    {
        return new AntelopeLocationUpdater($this->getAntelopeLocationFacade(), $this->createAntelopeLocationResourceBuilder());
    }

    public function createAntelopeLocationDeleter(): AntelopeLocationDeleterInterface
    {
        return new AntelopeLocationDeleter($this->getAntelopeLocationFacade(), $this->createAntelopeLocationResourceBuilder());
    }
}
