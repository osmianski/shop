<?php

declare(strict_types=1);

namespace App\Sheets\ColumnDbMigrators;

use App\Sheets\Column;
use App\Sheets\Sheet;
use Osm\Core\App;
use Osm\Core\Object_;
use Osm\Data\TableQueries\TableQuery;
use Osm\Data\Tables\Blueprint;
use Osm\Framework\Db\Db;

/**
 * @property Column $column @required
 * @property Blueprint $table
 *
 * Computed:
 *
 * @property Sheet $sheet @required
 * @property string $back_reference_name @required
 * @property string $back_reference_formula @required
 *
 * Dependencies:
 *
 * @property Db|TableQuery[] $db @required
 *
 */
class Migrator extends Object_
{
    /** @noinspection PhpUnused */
    protected function get_sheet(): Sheet {
        return $this->column->parent;
    }

    /** @noinspection PhpUnused */
    protected function get_db(): Db {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->db;
    }

    /** @noinspection PhpUnused */
    protected function get_back_reference_name(): string {
        $primaryColumnName = $this->sheet->primary_column->name;

        return "{$this->sheet->singular_name}_{$primaryColumnName}";
    }

    /** @noinspection PhpUnused */
    protected function get_back_reference_formula(): string {
        $primaryColumnName = $this->sheet->primary_column->name;

        return "{$this->sheet->name}.{$primaryColumnName}";
    }

    public function createWhileCreatingTable() {
        // by default, don't add any new columns to the main table
    }

    public function afterAdding() {
        // by default, don't do anything after the column has been added
        // to the sheet, either during the initial sheet creation or later
    }
}