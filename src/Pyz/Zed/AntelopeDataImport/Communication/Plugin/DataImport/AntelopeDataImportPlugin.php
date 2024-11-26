<?php

namespace Pyz\Zed\AntelopeDataImport\Communication\Plugin\DataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeDataImport\AntelopeDataImportConfig;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\AntelopeDataImport\Business\AntelopeDataImportFacadeInterface getFacade()
 */
class AntelopeDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{

    /**
     * @inheritDoc
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null)
    {
        return $this->getFacade()->importAntelope($dataImporterConfigurationTransfer);
    }

    /**
     * @inheritDoc
     */
    public function getImportType()
    {
        return AntelopeDataImportConfig::IMPORT_TYPE_ANTELOPE;
    }
}
