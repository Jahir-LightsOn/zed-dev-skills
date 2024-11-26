<?php

namespace Pyz\Zed\AntelopeDataImport;

use Spryker\Zed\DataImport\DataImportConfig;

class AntelopeDataImportConfig extends DataImportConfig
{
    public const IMPORT_TYPE_ANTELOPE = 'antelope';

    public const COLUMN_NAME = 'name';

    public const COLUMN_COLOR = 'color';

    public const COLUMN_AGE = 'age';

    public const COLUMN_WEIGHT = 'weight';

    public const COLUMN_GENDER = 'gender';

    public const COLUMN_FK_LOCATION = 'locationId';

    public const COLUMN_FK_TYPE = 'typeId';

}
