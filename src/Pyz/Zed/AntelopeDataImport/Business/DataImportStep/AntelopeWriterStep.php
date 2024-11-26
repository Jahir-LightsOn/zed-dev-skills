<?php

namespace Pyz\Zed\AntelopeDataImport\Business\DataImportStep;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Pyz\Zed\AntelopeDataImport\AntelopeDataImportConfig;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeWriterStep implements DataImportStepInterface
{
    /**
     * @inheritDoc
     */
    public function execute(DataSetInterface $dataSet)
    {
        $antelopeEntity = PyzAntelopeQuery::create()
            ->filterByName($dataSet[AntelopeDataImportConfig::COLUMN_NAME])
            ->findOneOrCreate();

        $antelopeEntity->setAge((int)$dataSet[AntelopeDataImportConfig::COLUMN_AGE])
            ->setColor($dataSet[AntelopeDataImportConfig::COLUMN_COLOR])
            ->setWeight((float)$dataSet[AntelopeDataImportConfig::COLUMN_WEIGHT])
            ->setGender($dataSet[AntelopeDataImportConfig::COLUMN_GENDER])
            ->setFkAntelopeLocation((int)$dataSet[AntelopeDataImportConfig::COLUMN_FK_LOCATION])
            ->setFkAntelopeType((int)$dataSet[AntelopeDataImportConfig::COLUMN_FK_TYPE]);

        if($antelopeEntity->isNew() || $antelopeEntity->isModified()) {
            $antelopeEntity->save();
        }
    }
}
