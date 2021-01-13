<?php

declare(strict_types=1);

namespace App\Sheets\ColumnElasticMigrators;

use App\Elastic\Index;
use App\Sheets\Column;
use App\Sheets\Sheet;
use Osm\Core\App;
use Osm\Core\Object_;

/**
 * @property Column $column @required
 *
 * Computed:
 *
 * @property Sheet $sheet @required
 *
 * Dependencies:
 *
 * @property Index $index @required
 *
 */
class Migrator extends Object_
{
    /** @noinspection PhpUnused */
    protected function get_sheet(): Sheet {
        return $this->column->parent;
    }

    /** @noinspection PhpUnused */
    protected function get_index(): Index {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->elastic[$this->sheet->name];
    }

    public function addToParams(array &$params): void {
        // by default don't add any mapping for the column
    }
}