<?php

declare(strict_types=1);

namespace App\Sheets\Indexes;

use App\Elastic\Index as ElasticIndex;
use App\Sheets\Indexes\Columns\Elastic\Column as ElasticColumn;
use Osm\Core\App;

/**
 * Computed:
 *
 * @property ElasticColumn[] $columns @required
 *
 * Dependencies:
 *
 * @property ElasticIndex $elastic @required
 */
class Elastic extends Index
{
    /** @noinspection PhpUnused */
    protected function get_elastic(): ElasticIndex {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->elastic[$this->parent->name];
    }

    /** @noinspection PhpUnused */
    protected function get_default_column_class(): string {
        return ElasticColumn::class;
    }

    public function create(): void {
        $this->drop();

        $params = [];
        foreach ($this->columns as $column) {
            $column->create($params);
        }

        $this->elastic->create($params);
    }

    public function drop(): void {
        if ($this->elastic->exists()) {
            $this->elastic->delete();
        }
    }
}