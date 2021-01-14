<?php

declare(strict_types=1);

namespace App\Sheets\Indexes;

use Osm\Core\Object_;
use Osm\Data\Sheets\Sheet;

/**
 * Constructor parameters:
 *
 * @property Sheet $parent @required
 */
class Index extends Object_
{
    public function create(): void {
        // by default do nothing
    }

    public function drop(): void {
        // by default do nothing
    }

    public function reindex(): void {
        // by default do nothing
    }
}