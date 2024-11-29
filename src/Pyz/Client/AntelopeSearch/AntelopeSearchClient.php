<?php

namespace Pyz\Client\AntelopeSearch;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Client\AntelopeSearch\Plugin\Elasticsearch\ResultFormatter\AntelopeSearchResultFormatterPlugin;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\AntelopeSearch\AntelopeSearchFactory getFactory()
 */
class AntelopeSearchClient extends AbstractClient implements AntelopeSearchClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $name
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer|null
     */
    public function getAntelopeByName(string $name): ?AntelopeTransfer
    {
        $searchQuery = $this->getFactory()->createAntelopeQueryPlugin($name);
        $searchQueryFormatters = $this->getFactory()->getSearchQueryFormatters();

        $resultFormatters = [];
        $searchClient = $this->getFactory()->getSearchClient();
        $searchResults = $searchClient->search($searchQuery, $searchQueryFormatters);
        return $searchResults[AntelopeSearchResultFormatterPlugin::NAME];
    }
}
