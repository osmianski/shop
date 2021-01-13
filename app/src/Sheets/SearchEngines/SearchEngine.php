<?php

declare(strict_types=1);

namespace App\Sheets\SearchEngines;

use Osm\Core\Object_;
use Osm\Data\Sheets\Sheet;

/**
 * Constructor parameters:
 *
 * @property Sheet $parent @required
 */
class SearchEngine extends Object_
{
    public function reindex(): void {
        // by default do nothing
    }
}