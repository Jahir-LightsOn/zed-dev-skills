<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Plugin;

use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributeTransfer;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig;
use Pyz\Glue\AntelopeLocationsBackendApi\Controller\AntelopeLocationsBackendApiResourceController;
use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;

class AntelopeLocationsBackendResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return AntelopeLocationsBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS;
    }

    /**
     * @inheritDoc
     */
    public function getController(): string
    {
       return AntelopeLocationsBackendApiResourceController::class;
    }

    /**
     * @inheritDoc
     */
    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        $collection = new GlueResourceMethodCollectionTransfer();
        $method = new GlueResourceMethodConfigurationTransfer();
        $attribute = AntelopeLocationsBackendApiAttributeTransfer::class;
        $method->setAttributes($attribute);
        $collection->setGetCollection($method);
        $collection->setGet((new GlueResourceMethodConfigurationTransfer())->setAttributes($attribute))
            ->setPost((new GlueResourceMethodConfigurationTransfer())->setAttributes($attribute))
            ->setPatch((new GlueResourceMethodConfigurationTransfer())->setAttributes($attribute))
            ->setDelete((new GlueResourceMethodConfigurationTransfer())->setAttributes($attribute));
        return $collection;
    }
}
