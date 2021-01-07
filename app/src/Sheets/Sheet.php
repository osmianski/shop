<?php

namespace App\Sheets;

use Osm\Core\Object_;

class Sheet extends Object_
{
    /**
     * @required @part
     */
    public string $name;

    /**
     * @required @part
     */
    public string $search_engine;

    /**
     * @required @part
     */
    public array $column_config;

    /**
     * @required @part
     * @var array|Column[]
     */
    public array $columns;
}