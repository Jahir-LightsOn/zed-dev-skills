<?php

namespace Pyz\Glue\AntelopesBackendApi;

use Pyz\Glue\AntelopesBackendApi\Processor\Deleter\AntelopeDeleter;
use Pyz\Glue\AntelopesBackendApi\Processor\Deleter\AntelopeDeleterInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\Expander\AntelopesExpander;
use Pyz\Glue\AntelopesBackendApi\Processor\Expander\AntelopesExpanderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\Reader\AntelopeReader;
use Pyz\Glue\AntelopesBackendApi\Processor\Reader\AntelopeReaderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilder;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\Updater\AntelopeUpdater;
use Pyz\Glue\AntelopesBackendApi\Processor\Updater\AntelopeUpdaterInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\Writer\AntelopeWriter;
use Pyz\Glue\AntelopesBackendApi\Processor\Writer\AntelopeWriterInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Glue\Kernel\Backend\AbstractFactory;

class AntelopesBackendApiFactory extends AbstractFactory
{
    public function createAntelopeReader(): AntelopeReaderInterface
    {
        return new AntelopeReader(
            $this->getAntelopeFacade(),
            $this->createAntelopeResponseBuilder(),
            $this->createAntelopeExpander()
        );
    }

    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopesBackendApiDependencyProvider::FACADE_ANTELOPE);
    }

    public function createAntelopeResponseBuilder(): AntelopeResponseBuilderInterface
    {
        return new AntelopeResponseBuilder();
    }

    public function createAntelopeExpander(): AntelopesExpanderInterface
    {
        return new AntelopesExpander();
    }

    public function createAntelopeWriter(): AntelopeWriterInterface
    {
        return new AntelopeWriter(
            $this->getAntelopeFacade(),
            $this->createAntelopeResponseBuilder()
        );
    }

    public function createAntelopeUpdater(): AntelopeUpdaterInterface
    {
        return new AntelopeUpdater(
            $this->getAntelopeFacade(),
            $this->createAntelopeResponseBuilder()
        );
    }

    public function createAntelopeDeleter(): AntelopeDeleterInterface
    {
        return new AntelopeDeleter(
            $this->getAntelopeFacade(),
            $this->createAntelopeResponseBuilder()
        );
    }
}
