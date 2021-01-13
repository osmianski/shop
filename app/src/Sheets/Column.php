<?php

namespace App\Sheets;

use App\Elastic\Index;
use App\Sheets\ColumnDbMigrators\Migrator as DbMigrator;
use App\Sheets\ColumnDbMigrators\Migrators as DbMigrators;
use App\Sheets\ColumnElasticMigrators\Migrator as ElasticMigrator;
use App\Sheets\ColumnElasticMigrators\Migrators as ElasticMigrators;
use Osm\Core\App;
use Osm\Core\Object_;
use Osm\Data\Tables\Blueprint;

/**
 * @property string $name @required @part
 * @property Sheet $parent @required
 *
 * Properties:
 *
 * @property bool $required @part
 * @property bool $primary @part
 * @property string $db_migrator @part
 * @property string $elastic_migrator @part
 *
 * Dependencies:
 *
 * @property DbMigrators $db_migrators @required
 * @property ElasticMigrators $elastic_migrators @required
 */
class Column extends Object_
{
    /** @noinspection PhpUnused */
    protected function get_db_migrators() {
        global $osm_app; /* @var App $osm_app */

        return $osm_app[DbMigrators::class];
    }

    /** @noinspection PhpUnused */
    protected function get_elastic_migrators() {
        global $osm_app; /* @var App $osm_app */

        return $osm_app[ElasticMigrators::class];
    }

    protected function createDbMigrator(?Blueprint $table = null): ?DbMigrator {
        if (!$this->db_migrator) {
            return null;
        }

        return DbMigrator::new([
            'class' => $this->db_migrators[$this->db_migrator],
            'column' => $this,
            'table' => $table,
        ]);
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

    public function createInTable(Blueprint $table) {
        $this->createDbMigrator($table)?->createWhileCreatingTable();
    }

    public function afterAdding() {
        $this->createDbMigrator()?->afterAdding();
    }

    public function createInElasticIndex(array &$params) {
        $this->createElasticMigrator()?->addToParams($params);
    }
}