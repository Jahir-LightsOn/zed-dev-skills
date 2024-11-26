<?php

namespace Pyz\Zed\AntelopeLocationDataImport\Business\DataImportStep;

use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery;
use Pyz\Shared\AntelopeLocationSearch\AntelopeLocationSearchConfig;
use Pyz\Zed\AntelopeLocationDataImport\AntelopeLocationDataImportConfig;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeLocationWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    public function execute(DataSetInterface $dataSet)
    {
        $antelopeLocationEntity = PyzAntelopeLocationQuery::create()
            ->filterByLocationName($dataSet[AntelopeLocationDataImportConfig::COLUMN_LOCATION_NAME])
            ->findOneOrCreate();

        $antelopeLocationEntity->setLatitude((float)$dataSet[AntelopeLocationDataImportConfig::COLUMN_LOCATION_LATITUDE])
            ->setLongitude((float)$dataSet[AntelopeLocationDataImportConfig::COLUMN_LOCATION_LONGITUDE]);

        if ($antelopeLocationEntity->isNew() || $antelopeLocationEntity->isModified()) {
            $antelopeLocationEntity->save();
            $this->addPublishEvents(AntelopeLocationSearchConfig::ANTELOPE_LOCATION_PUBLISH, $antelopeLocationEntity->getIdAntelopeLocation());
        }
    }
}
