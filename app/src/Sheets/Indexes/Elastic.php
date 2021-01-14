<?php

declare(strict_types=1);

namespace App\Sheets\Indexes;

use App\Elastic\Index as ElasticIndex;
use App\Sheets\Sheets\Sheet;
use Osm\Core\App;

/**
 * Constructor parameters:
 *
 * @property Sheet $parent @required
 *
 * Dependencies:
 *
 * @property ElasticIndex $index @required
 */
class Elastic extends Index
{
    /** @noinspection PhpUnused */
    protected function get_index(): ElasticIndex {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->elastic[$this->parent->name];
    }

    public function create(): void {
        $this->drop();

        $params = [];
        foreach ($this->parent->columns as $column) {
            $column->createInElasticIndex($params);
        }

        $this->index->create($params);
    }

    public function drop(): void {
        if ($this->index->exists()) {
            $this->index->delete();
        }
    }
}