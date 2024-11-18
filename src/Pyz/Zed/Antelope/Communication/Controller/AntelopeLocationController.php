<?php

namespace Pyz\Zed\Antelope\Communication\Controller;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeFacadeInterface getFacade()
 */
class AntelopeLocationController extends AbstractController
{
    /**
     * @param Request $request
     * @return array<string,mixed>
     */
    public function addAction(Request $request): array
    {
        $locationName = $request->get('name') ?? 'Berlin';

        $antelopeLocationTransfer = new AntelopeLocationTransfer();
        $antelopeLocationTransfer->setLocationName($locationName);

        $antelopeLocationResponseTransfer = $this->getFacade()
            ->getAntelopeLocation((new AntelopeLocationCriteriaTransfer())->setLocationName($locationName));

        if (!$antelopeLocationResponseTransfer->getIsSuccessFul()) {
            $antelopeLocationTransfer = $this->getFacade()->createAntelopeLocation($antelopeLocationTransfer);
        } else {
            $antelopeLocationTransfer = $antelopeLocationResponseTransfer->getAntelopeLocation();
        }

        return $this->viewResponse(['antelopeLocation' => $antelopeLocationTransfer]);
    }
}
