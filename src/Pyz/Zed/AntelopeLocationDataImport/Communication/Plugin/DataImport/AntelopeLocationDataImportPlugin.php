<?php

namespace Pyz\Zed\AntelopeLocationDataImport\Communication\Plugin\DataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeLocationDataImport\AntelopeLocationDataImportConfig;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\AntelopeLocationDataImport\Business\AntelopeLocationDataImportFacadeInterface getFacade()
 */
class AntelopeLocationDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{

    /**
     * @inheritDoc
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null)
    {
        return $this->getFacade()->importAntelopeLocation($dataImporterConfigurationTransfer);
    }

    /**
     * @inheritDoc
     */
    public function getImportType()
    {
        return AntelopeLocationDataImportConfig::IMPORT_TYPE_ANTELOPE_LOCATION;
    }
}
