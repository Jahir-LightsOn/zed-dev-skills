<?php

namespace Pyz\Zed\Antelope\Communication\Controller;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use http\Exception\InvalidArgumentException;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface getFacade()
 */
class AntelopeController extends AbstractController
{
    /**
     * @param Request $request
     * @return array<string,mixed>
     */
    public function addAction(Request $request): array
    {
        $antelopeTransfer = new AntelopeTransfer();
        $antelopeTransfer->setName($request->get('name') ?? 'Oskar');
        // check for antelope location
        $locationId = $request->get('locationId') ?? null;
        if (empty($locationId)) {
            throw new InvalidArgumentException('Location ID is required');
        }
        $antelopeLocationCriteriaTransfer = new AntelopeLocationCriteriaTransfer();
        $antelopeLocationCriteriaTransfer->setIdAntelopeLocation($locationId);
        $antelopeLocation = $this->getFacade()->getAntelopeLocation($antelopeLocationCriteriaTransfer);
        if ($antelopeLocation->getIsSuccessFul() === false) {
            throw new NotFoundHttpException('Location not found');
        }
        $antelopeTransfer->setFkAntelopeLocation($locationId);
        $this->getFacade()->createAntelope($antelopeTransfer);
        return $this->viewResponse(['antelope' => $antelopeTransfer]);
    }
}
