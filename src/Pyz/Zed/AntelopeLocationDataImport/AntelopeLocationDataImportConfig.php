<?php

namespace Pyz\Zed\AntelopeLocationDataImport;

use Spryker\Zed\DataImport\DataImportConfig;

class AntelopeLocationDataImportConfig extends DataImportConfig
{
    public const IMPORT_TYPE_ANTELOPE_LOCATION = 'antelope-location';

    public const COLUMN_LOCATION_NAME = 'name';

    public const COLUMN_LOCATION_LATITUDE = 'latitude';

    public const COLUMN_LOCATION_LONGITUDE = 'longitude';
}
