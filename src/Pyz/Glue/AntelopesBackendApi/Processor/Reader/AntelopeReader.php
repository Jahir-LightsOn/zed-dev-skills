<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Reader;


use Generated\Shared\Transfer\AntelopeConditionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\Processor\Expander\AntelopesExpanderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeReader implements AntelopeReaderInterface
{
    public function __construct(
        private readonly AntelopeFacadeInterface $facade,
        private readonly AntelopeResponseBuilderInterface $responseBuilder,
        private readonly AntelopesExpanderInterface $antelopesExpander
    ){
    }

    public function getCollectionAction(GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $conditions = new AntelopeConditionTransfer();
        $this->antelopesExpander->expandWithFilters($conditions, $requestTransfer);
        $antelopeCriteriaTransfer->setPagination($requestTransfer->getPagination())
            ->setSortCollection($requestTransfer->getSortings())
            ->setAntelopeConditions($conditions);
        return $this->getAntelopeCollectionTransfer($antelopeCriteriaTransfer);
    }

    public function getAntelope(GlueRequestTransfer $requestTransfer
    ): GlueResponseTransfer {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $conditions = new AntelopeConditionTransfer();
        $conditions->setIdAntelope((int)$requestTransfer->getResource()?->getId());
        $antelopeCriteriaTransfer->setAntelopeConditions($conditions);
        return $this->getAntelopeCollectionTransfer($antelopeCriteriaTransfer);
    }

    /**
     * @param AntelopeCriteriaTransfer $antelopeCriteriaTransfer
     * @return GlueResponseTransfer
     */
    public function getAntelopeCollectionTransfer(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): GlueResponseTransfer {
        $antelopeCollectionTransfer = $this->facade
            ->getAntelopeCollection($antelopeCriteriaTransfer);

        return $this->responseBuilder->createAntelopeResponse($antelopeCollectionTransfer);
    }
}
