<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationsBackendApiAttributeTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueErrorTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\AntelopeLocationsBackendApiConfig;
use Symfony\Component\HttpFoundation\Response;

class AntelopeLocationResponseBuilder implements AntelopeLocationResponseBuilderInterface
{
    public function __construct(
        private readonly AntelopeLocationsBackendApiConfig $antelopeLocationsBackendApiConfig
    ){

    }

    public function createAntelopeLocationResponse(AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer): GlueResponseTransfer
    {
        $responseTransfer = new GlueResponseTransfer();
        foreach ($antelopeLocationCollectionTransfer->getAntelopeLocations() as $antelopeLocation) {
            $resourceTransfer = $this->mapAntelopeLocationDtoToGlueResourceTransfer($antelopeLocation);
            $responseTransfer->addResource($resourceTransfer);
        }
        return $responseTransfer;
    }

    /**
     * @param mixed $antelopeLocation
     * @return GlueResourceTransfer
     */
    public function mapAntelopeLocationDtoToGlueResourceTransfer(AntelopeLocationTransfer $antelopeLocation): GlueResourceTransfer
    {
        $resourceTransfer = new GlueResourceTransfer();
        $resourceTransfer->setType(AntelopeLocationsBackendApiConfig::RESOURCE_ANTELOPE_LOCATIONS);
        $resourceTransfer->setId('' . $antelopeLocation->getIdAntelopeLocation());
        $resourceTransfer->setAttributes((new AntelopeLocationsBackendApiAttributeTransfer())->fromArray($antelopeLocation->toArray(), true));
        return $resourceTransfer;
    }

    public function createAntelopeLocationSingleErrorResponse(string $message): GlueResponseTransfer
    {
        $errorTransferCollection = new \ArrayObject();
        $errorTransferCollection->append(
            $this->createErrorTransfer($message),
        );

        return $this->createAntelopeLocationErrorResponse($errorTransferCollection);
    }

    /**
     * @param string $message
     *
     * @return \Generated\Shared\Transfer\ErrorTransfer
     */
    protected function createErrorTransfer(string $message): ErrorTransfer
    {
        return (new ErrorTransfer())->setMessage($message);
    }

    /**
     * @param \ArrayObject<array-key, \Generated\Shared\Transfer\ErrorTransfer> $errorTransfers
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function createAntelopeLocationErrorResponse(\ArrayObject $errorTransfers ): GlueResponseTransfer {
        $glueResponseTransfer = new GlueResponseTransfer();
        $validationKeyToRestErrorMapping = $this->antelopeLocationsBackendApiConfig
            ->getValidationKeyToRestErrorMapping();

        foreach ($errorTransfers as $errorTransfer) {
            $glueResponseTransfer = $this->expandGlueResponseTransferWithError(
                $errorTransfer,
                $glueResponseTransfer,
                $validationKeyToRestErrorMapping,
            );
        }

        return $this->setGlueResponseHttpStatus($glueResponseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErrorTransfer $errorTransfer
     * @param \Generated\Shared\Transfer\GlueResponseTransfer $glueResponseTransfer
     * @param array<string, array<string, mixed>> $validationKeyToRestErrorMapping
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    protected function expandGlueResponseTransferWithError(
        ErrorTransfer $errorTransfer,
        GlueResponseTransfer $glueResponseTransfer,
        array $validationKeyToRestErrorMapping
    ): GlueResponseTransfer {
        $message = $errorTransfer->getMessageOrFail();

        if (!isset($validationKeyToRestErrorMapping[$message])) {
            return $glueResponseTransfer->addError(
                $this->createUnknownGlueErrorTransfer($message),
            );
        }

        return $glueResponseTransfer->addError(
            $this->mapRestErrorToGlueErrorTransfer($validationKeyToRestErrorMapping[$message]),
        );
    }

    /**
     * @param string $message
     *
     * @return \Generated\Shared\Transfer\GlueErrorTransfer
     */
    protected function createUnknownGlueErrorTransfer(string $message): GlueErrorTransfer
    {
        return (new GlueErrorTransfer())
            ->setMessage($message)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setCode('');
    }

    /**
     * @param array<string, mixed> $restError
     *
     * @return \Generated\Shared\Transfer\GlueErrorTransfer
     */
    protected function mapRestErrorToGlueErrorTransfer(array $restError): GlueErrorTransfer
    {
        return (new GlueErrorTransfer())
            ->fromArray($restError, true);
    }

    /**
     * @param \Generated\Shared\Transfer\GlueResponseTransfer $glueResponseTransfer
     *
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    protected function setGlueResponseHttpStatus(GlueResponseTransfer $glueResponseTransfer): GlueResponseTransfer
    {
        /** @var \ArrayObject<array-key, \Generated\Shared\Transfer\GlueErrorTransfer> $errorTransferCollection */
        $errorTransferCollection = $glueResponseTransfer->getErrors();
        if ($errorTransferCollection->count() !== 1) {
            return $glueResponseTransfer->setHttpStatus(
                Response::HTTP_MULTI_STATUS,
            );
        }

        $errorTransfer = $errorTransferCollection->getIterator()->current();

        return $glueResponseTransfer->setHttpStatus(
            $errorTransfer->getStatus(),
        );
    }
}
