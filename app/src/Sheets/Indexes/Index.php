<?php

declare(strict_types=1);

namespace App\Sheets\Indexes;

use App\Sheets\Indexes\Columns\Column;
use App\Sheets\Indexes\Columns\ColumnTypes;
use App\Sheets\Module;
use App\Sheets\Sheets\Sheet;
use Osm\Core\App;
use Osm\Core\Modules\BaseModule;
use Osm\Core\Object_;

/**
 * Constructor parameters:
 *
 * @property Sheet $parent @required
 * @property string $type @required @part
 *
 * Computed:
 *
 * @property Column[] $columns @required
 * @property string $default_column_class @required
 *
 * Dependencies:
 *
 * @property Module $sheet_module @required
 * @property ColumnTypes|string[] $column_types @required
 *
 */
class Index extends Object_
{
    /** @noinspection PhpUnused */
    protected function get_sheet_module(): Module|BaseModule {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->modules['App_Sheets'];
    }

    /** @noinspection PhpUnused */
    protected function get_column_types(): ColumnTypes {
        return $this->sheet_module->index_column_types;
    }

    /** @noinspection PhpUnused */
    protected function get_columns(): array {
        $result = [];

        foreach ($this->parent->columns as $name => $column) {
            $type = "{$this->type}__{$column->type}";

            $result[$name] = Column::new([
                'name' => $name,
                'type' => $column->type,
                'class' => $this->column_types[$type] ?? $this->default_column_class,
                'sheet_column' => $column,
            ]);
        }

        return $result;
    }

    public function create(): void {
        // by default do nothing
    }

    public function drop(): void {
        // by default do nothing
    }

    public function reindex(): void {
        // by default do nothing
    }
}