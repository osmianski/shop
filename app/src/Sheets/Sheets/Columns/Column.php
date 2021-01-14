<?php

namespace App\Sheets\Sheets\Columns;

use App\Sheets\Sheets\Sheet;
use Osm\Core\Object_;

/**
 * @property string $name @required @part
 * @property Sheet $parent @required
 *
 * Properties:
 *
 * @property string $type @required @part
 * @property bool $required @part
 * @property float $search_weight @part
 *
 * Computed:
 *
 * @property bool $primary @part
 */
class Column extends Object_
{
}