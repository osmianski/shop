<?php

declare(strict_types=1);

namespace App\Sheets\ColumnDbMigrators;

use Osm\Core\App;
use Osm\Core\Object_;
use Osm\Data\TableQueries\TableQuery;
use Osm\Data\Tables\Blueprint;
use Osm\Framework\Db\Db;

/**
 * Dependencies:
 *
 * @property Db|TableQuery[] $db @required
 */
class FileBackReference extends Object_
{

    /** @noinspection PhpUnused */
    protected function get_db(): Db {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->db;
    }

    public function create($columnName, $references) {
        if (isset($this->db->tables['files']->columns[$columnName])) {
            return;
        }

        $this->db->alter('files', function(Blueprint $table)
            use ($columnName, $references)
        {
            $table->int($columnName)->title($columnName)
                ->unsigned()->pinned()
                ->references($references)->on_delete('set null');
        });

    }
}