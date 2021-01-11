<?php

namespace App\Sheets;

use App\Sheets\ColumnDbMigrators\Migrator;
use App\Sheets\ColumnDbMigrators\Migrators;
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
 *8
 * Dependencies:
 *
 * @property Migrators $db_migrators @required
 */
class Column extends Object_
{
    protected function get_db_migrators() {
        global $osm_app; /* @var App $osm_app */

        return $osm_app[Migrators::class];
    }

    protected function createDbMigrator(?Blueprint $table = null): ?Migrator {
        if (!$this->db_migrator) {
            return null;
        }

        return Migrator::new([
            'class' => $this->db_migrators[$this->db_migrator],
            'column' => $this,
            'table' => $table,
        ]);
    }

    public function createInTable(Blueprint $table) {
        $this->createDbMigrator($table)?->createWhileCreatingTable();
    }

    public function afterAdding() {
        $this->createDbMigrator()?->afterAdding();
    }
}