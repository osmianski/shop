<?php

declare(strict_types=1);

namespace App\Sheets\Sheets;

use App\Sheets\Sheets\Columns\Table\Column;
use Osm\Core\App;
use Osm\Data\TableQueries\TableQuery;
use Osm\Data\Tables\Blueprint;
use Osm\Framework\Db\Db;

/**
 * Computed:
 *
 * @property array|Column[] $columns @required @part
 *
 * Dependencies:
 *
 * @property Db|TableQuery[] $db @required
 */
class Table extends Sheet
{
    public string $type = 'table';

    /** @noinspection PhpUnused */
    protected function get_db(): Db {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->db;
    }

    public function create(): void {
        $this->db->create($this->name, function (Blueprint $table) {
            foreach ($this->columns as $column) {
                $column->create($table);
            }
        });

        foreach ($this->columns as $column) {
            $column->afterCreated();
        }

        parent::create();
    }

    public function drop(): void {
        foreach ($this->columns as $column) {
            $column->beforeDropping();
        }

        $this->db->drop($this->name);

        parent::drop();
    }
}