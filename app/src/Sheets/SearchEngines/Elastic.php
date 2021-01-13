<?php

declare(strict_types=1);

namespace App\Sheets\SearchEngines;

use App\Elastic\Index;
use App\Sheets\Sheet;
use Osm\Core\App;

/**
 * Constructor parameters:
 *
 * @property Sheet $parent @required
 *
 * Dependencies:
 *
 * @property Index $index @required
 */
class Elastic extends SearchEngine
{
    /** @noinspection PhpUnused */
    protected function get_index(): Index {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->elastic[$this->parent->name];
    }

    public function reindex(): void {
        if ($this->index->exists()) {
            $this->index->delete();
        }

        $params = [];
        foreach ($this->parent->columns as $column) {
            $column->createInElasticIndex($params);
        }

        $this->index->create($params);
    }
}