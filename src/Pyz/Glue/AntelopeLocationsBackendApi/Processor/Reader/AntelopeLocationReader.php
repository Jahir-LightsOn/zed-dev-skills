<?php

namespace Pyz\Glue\AntelopeLocationsBackendApi\Processor\Reader;

use Generated\Shared\Transfer\AntelopeLocationConditionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeLocationsBackendApi\Processor\ResponseBuilder\AntelopeLocationResponseBuilderInterface;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;

class AntelopeLocationReader implements AntelopeLocationReaderInterface
{
    public function __construct(
        private readonly AntelopeLocationFacadeInterface $antelopeLocationFacade,
        private readonly AntelopeLocationResponseBuilderInterface $antelopeLocationResponseBuilder
    ){

    }

    /**
     * @param GlueRequestTransfer $glueRequestTransfer
     * @return GlueResponseTransfer
     */
    public function getAntelopeLocationCollection(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $conditions = new AntelopeLocationConditionTransfer();
        $antelopeLocationCriteriaTransfer->setPagination($glueRequestTransfer->getPagination())
            ->setSortCollection($glueRequestTransfer->getSortings())
            ->setAntelopeLocationConditions($conditions);
        return $this->getAntelopeLocationCollectionTransfer($antelopeLocationCriteriaTransfer);
    }

    /**
     * @param GlueRequestTransfer $requestTransfer
     * @return GlueResponseTransfer
     */
    public function getAntelopeLocation(GlueRequestTransfer $requestTransfer
    ): GlueResponseTransfer {
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $conditions = new AntelopeLocationConditionTransfer();
        $conditions->setIdAntelopeLocation((int)$requestTransfer->getResource()?->getId());
        $antelopeLocationCriteriaTransfer->setAntelopeLocationConditions($conditions);
        return $this->getAntelopeLocationCollectionTransfer($antelopeLocationCriteriaTransfer);
    }

    private function getAntelopeLocationCollectionTransfer(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer): GlueResponseTransfer
    {
        $antelopeLocationCollectionTransfer = $this->antelopeLocationFacade->getAntelopeLocationCollection($antelopeLocationCriteriaTransfer);
        return $this->antelopeLocationResponseBuilder->createAntelopeLocationResponse($antelopeLocationCollectionTransfer);
    }
}
