<?php

declare(strict_types=1);

namespace App\Sheets\Sheets\Columns\Table;

use App\Sheets\Sheets\Columns\Column as BaseColumn;
use Osm\Core\App;
use Osm\Data\TableQueries\TableQuery;
use Osm\Data\Tables\Blueprint;
use Osm\Framework\Db\Db;

/**
 * Dependencies:
 *
 * @property Db|TableQuery[] $db @required
 */
class Column extends BaseColumn
{
    /** @noinspection PhpUnused */
    protected function get_db(): Db {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->db;
    }

    public function create(Blueprint $table) {
        // by default, do nothing
    }

    public function afterCreated() {
        // by default, do nothing
    }

    /**
     * Creates a foreign key in $table referencing this sheet's primary key.
     * For example, if the sheet name is 'products', then the foreign key is
     * 'product_id', unless $columnName specifies otherwise. Foreign records
     * are automatically deleted if the sheet's record is deleted, unless
     * $cascadeDelete specifies otherwise.
     *
     * @param Blueprint $table
     * @param string|null $columnName
     * @param bool $cascadeDelete
     */
    protected function createBackReference(Blueprint $table,
        ?string $columnName = null, bool $cascadeDelete = true)
    {
        if (!$columnName) {
            $columnName = $this->parent->singular_name . '_' .
                $this->parent->primary_column->name;
        }

        if (isset($this->db->tables[$table->name]->columns[$columnName])) {
            return;
        }

        $references = $this->parent->name . '.' .
            $this->parent->primary_column->name;

        $table->int($columnName)->title($columnName)
            ->unsigned()->pinned()->required($cascadeDelete)
            ->references($references)
            ->on_delete($cascadeDelete ? 'cascade' : 'set null');
    }
}