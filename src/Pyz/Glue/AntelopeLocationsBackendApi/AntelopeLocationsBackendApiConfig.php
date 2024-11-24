<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi;

use Generated\Shared\Transfer\GlueErrorTransfer;
use Spryker\Glue\Kernel\AbstractBundleConfig;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationsBackendApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_ANTELOPE_LOCATIONS = 'antelope-locations';

    public const ANTELOPE_LOCATION_NOT_FOUND = 'ANTELOPE_LOCATION_NOT_FOUND';


    public const ANTELOPE_LOCATION_NOT_CREATED = 'ANTELOPE_LOCATION_NOT_CREATED';

    public const ANTELOPE_LOCATION_NOT_UPDATED = 'ANTELOPE_LOCATION_NOT_UPDATED';

    public const VALIDATION_WRONG_REQUEST_BODY = 'VALIDATION_WRONG_REQUEST_BODY';

    /**
     * @var string
     */
    protected const RESPONSE_CODE_ENTITY_NOT_FOUND = '5303';

    /**
     * @var string
     */
    protected const RESPONSE_CODE_ENTITY_NOT_CREATED = '5304';

    /**
     * @var string
     */
    protected const RESPONSE_CODE_ENTITY_NOT_UPDATED = '5305';
    protected const RESPONSE_CODE_WRONG_REQUEST_BODY = '5306';

    /**
     * Specification:
     * - Returns a map of glossary keys to REST Error data.
     *
     * @api
     *
     * @return array<string, array<string, mixed>>
     */
    public function getValidationKeyToRestErrorMapping(): array
    {
        return [
            static::ANTELOPE_LOCATION_NOT_FOUND => [
                GlueErrorTransfer::CODE => static::RESPONSE_CODE_ENTITY_NOT_FOUND,
                GlueErrorTransfer::STATUS => Response::HTTP_NOT_FOUND,
                GlueErrorTransfer::MESSAGE => 'Antelope location not found.',
            ],
            static::ANTELOPE_LOCATION_NOT_CREATED => [
                GlueErrorTransfer::CODE => static::RESPONSE_CODE_ENTITY_NOT_CREATED,
                GlueErrorTransfer::STATUS => Response::HTTP_INTERNAL_SERVER_ERROR,
                GlueErrorTransfer::MESSAGE => 'Antelope location not created.',
            ],
            static::ANTELOPE_LOCATION_NOT_UPDATED => [
                GlueErrorTransfer::CODE => static::RESPONSE_CODE_ENTITY_NOT_UPDATED,
                GlueErrorTransfer::STATUS => Response::HTTP_INTERNAL_SERVER_ERROR,
                GlueErrorTransfer::MESSAGE => 'Antelope location not updated.',
            ],
            static::VALIDATION_WRONG_REQUEST_BODY => [
                GlueErrorTransfer::CODE => static::RESPONSE_CODE_WRONG_REQUEST_BODY,
                GlueErrorTransfer::STATUS => Response::HTTP_BAD_REQUEST,
                GlueErrorTransfer::MESSAGE => "Request body is not valid.",
            ],
        ];
    }
}
