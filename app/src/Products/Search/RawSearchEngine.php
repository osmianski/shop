<?php

namespace App\Products\Search;

use Osm\Core\Exceptions\NotImplemented;

class RawSearchEngine extends SearchEngine
{
    protected function doRun(): Data {
        throw new NotImplemented();
    }
}