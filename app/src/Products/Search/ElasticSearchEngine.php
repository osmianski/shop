<?php

namespace App\Products\Search;

use Osm\Core\Exceptions\NotImplemented;

class ElasticSearchEngine extends SearchEngine
{
    protected function doRun(): Data {
        throw new NotImplemented();
    }
}