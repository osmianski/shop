<?php

namespace App\Products\Search;

use App\Products\Query;
use Osm\Core\Object_;

abstract class SearchEngine extends Object_
{
    public static function run(Query $query): Data {
        return static::new(['query' => $query])->doRun();
    }

    abstract protected function doRun(): Data;
}