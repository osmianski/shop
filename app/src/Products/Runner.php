<?php

namespace App\Products;

use Osm\Core\Exceptions\NotImplemented;
use Osm\Core\Object_;

/**
 * Runs a Query and returns Dataset as a result
 */
class Runner extends Object_
{
    /**
     * Query to be executed
     *
     * @required
     */
    public Query $query;

    /**
     * Dataset to be returned as a result
     *
     * @required
     */
    public Dataset $result;

    /**
     * If set, all intermediate row ID arrays will not bigger than this setting.
     * In case this limit is exceeded, the query execution is simplified and
     * the warnings are added to the dataset accordingly
     */
    public ?int $max_id_array_size;

    protected function default($property): mixed {
        switch ($property) {
            case 'result': return Dataset::new();
        }

        return parent::default($property);
    }

    public static function run(Query $query): Dataset {
        return static::new(['query' => $query])->doRun();
    }

    protected function doRun(): Dataset {
        // If search or facets are not requested, don't use ElasticSearch
        // at all
        if (empty($this->query->search) && empty($this->query->facets)) {
            return $this->runRaw();
        }

        // If formula filters are also requested, then IDs matching
        // the formula filters are fetched, and then the returned IDs are
        // passed to the ElasticSearch. However, if the ID array too long,
        // search will not run with a warning, and facets will be counted
        // without using ElasticSearch
        if (!empty($this->query->formula_filters) && $this->max_id_array_size) {
            $formulaFilterResultSize = $this->estimateFormulaFilterResultSize();
            if ($formulaFilterResultSize > $this->max_id_array_size) {
                // TODO: continue here
                $this->result->search_warning = '';
            }
        }

        // in most cases, use the main search server - by default,
        // ElasticSearch
        $useMainSearch = true;


//        if ($this->isAdvancedFilteringRequested()) {
//            $useMainSearch = isset($this->max_id_array_size) &&
//                $this->countAdvancedFilteringQueryRows() < $this->max_id_array_size;
//        }

        if ($this->isSearchOrFacetsRequested()) {
            $searchResult = $this->search();
            if ($searchResult->ok) {
                $this->queryDataBasedOnSearch($searchResult->rows);
                $this->queryFacets($searchResult->facets);
            }
            else {
                throw new NotImplemented();
            }
        }
        else {
            throw new NotImplemented();
        }

        return Dataset::new($data);
    }

    protected function runRaw(): Dataset {
        throw new NotImplemented();
    }

    protected function estimateFormulaFilterResultSize(): int {
        throw new NotImplemented();
    }
}