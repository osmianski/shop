<?php

namespace App\Sheets\Sheets\Columns;

use App\Sheets\ColumnElasticMigrators\Migrator as ElasticMigrator;
use App\Sheets\ColumnElasticMigrators\Migrators as ElasticMigrators;
use App\Sheets\Sheets\Sheet;
use Osm\Core\App;
use Osm\Core\Object_;

/**
 * @property string $name @required @part
 * @property Sheet $parent @required
 *
 * Properties:
 *
 * @property string $type @required @part
 * @property bool $required @part
 * @property string $db_migrator @part
 * @property string $elastic_migrator @part
 *
 * Computed:
 *
 * @property bool $primary @part
 *
 * Dependencies:
 *
 * @property ElasticMigrators $elastic_migrators @required
 */
class Column extends Object_
{
    /** @noinspection PhpUnused */
    protected function get_elastic_migrators() {
        global $osm_app; /* @var App $osm_app */

        return $osm_app[ElasticMigrators::class];
    }

    protected function createElasticMigrator(): ?ElasticMigrator {
        if (!$this->elastic_migrator) {
            return null;
        }

        return ElasticMigrator::new([
            'class' => $this->elastic_migrators[$this->elastic_migrator],
            'column' => $this,
        ]);
    }

    public function createInElasticIndex(array &$params) {
        $this->createElasticMigrator()?->addToParams($params);
    }
}