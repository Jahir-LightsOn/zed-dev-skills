<?php

namespace Pyz\Zed\AntelopeLocationGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \Pyz\Zed\AntelopeLocationGui\Communication\AntelopeLocationGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    public function indexAction()
    {
        $table = $this->getFactory()->createAntelopeLocationTable();

        return $this->viewResponse([
            'antelopeLocationTable' => $table->render(),
        ]);
    }

    public function tableAction()
    {
        $table = $this->getFactory()->createAntelopeLocationTable();

        return $this->jsonResponse($table->fetchData());
    }
}
