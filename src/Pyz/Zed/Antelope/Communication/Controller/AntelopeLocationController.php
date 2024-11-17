<?php

namespace Pyz\Zed\Antelope\Communication\Controller;

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
        $antelopeLocationTransfer = new AntelopeLocationTransfer();
        $antelopeLocationTransfer->setLocationName($request->get('name') ?? 'Berlin');
        $this->getFacade()->createAntelopeLocation($antelopeLocationTransfer);
        return $this->viewResponse(['antelopeLocation' => $antelopeLocationTransfer]);
    }
}
