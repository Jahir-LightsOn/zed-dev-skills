<?php

namespace Pyz\Glue\AntelopesBackendApi\Plugin;

use Generated\Shared\Transfer\AntelopesBackendApiAttributeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;
use Pyz\Glue\AntelopesBackendApi\Controller\AntelopeBackendApiResourceController;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;
use Spryker\Glue\Kernel\Backend\AbstractPlugin;

class AntelopesBackendResourcePlugin extends AbstractPlugin implements JsonApiResourceInterface
{

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return AntelopesBackendApiConfig::RESOURCE_ANTELOPES;
    }

    /**
     * @inheritDoc
     */
    public function getController(): string
    {
        return AntelopeBackendApiResourceController::class;
    }

    /**
     * @inheritDoc
     */
    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        $collection = new GlueResourceMethodCollectionTransfer();
        $method = new GlueResourceMethodConfigurationTransfer();
        $attribute = AntelopesBackendApiAttributeTransfer::class;
        $method->setAttributes($attribute);

        $collection->setGetCollection($method);
        $collection->setGet((new GlueResourceMethodConfigurationTransfer())->setAttributes($attribute))
            ->setPost((new GlueResourceMethodConfigurationTransfer())->setAttributes($attribute))
            ->setPatch((new GlueResourceMethodConfigurationTransfer())->setAttributes($attribute))
            ->setDelete((new GlueResourceMethodConfigurationTransfer())->setAttributes($attribute));
        return $collection;
    }

    public function getResource(GlueRequestTransfer $glueRequestTransfer): callable
    {
        // TODO: Implement getResource() method.
    }
}
