<?php

namespace App\Sheets\Sheets;

use App\Sheets\Exceptions\InvalidDefinition;
use App\Sheets\Indexes\Index;
use App\Sheets\Indexes\IndexTypes;
use App\Sheets\Module;
use App\Sheets\Sheets\Columns\Column;
use App\Sheets\Sheets\Columns\ColumnTypes;
use Osm\Core\App;
use Osm\Core\Modules\BaseModule;
use Osm\Core\Object_;

/**
 * Constructor parameters:
 *
 * @property string $name @required @part
 * @property string $type @required @part
 * @property string $index_type @required @part
 * @property string $singular_name @required @part
 * @property array $column_config @required @part
 *
 * Computed:
 *
 * @property array|Column[] $columns @required @part
 * @property Index $index @required @part
 * @property Column $primary_column @required
 *
 * Dependencies:
 *
 * @property Module $sheet_module @required
 * @property ColumnTypes|string[] $column_types @required
 * @property IndexTypes|string[] $index_types @required
 */
class Sheet extends Object_
{
    /** @noinspection PhpUnused */
    protected function get_sheet_module(): Module|BaseModule {
        global $osm_app; /* @var App $osm_app */

        return $osm_app->modules['App_Sheets'];
    }

    /** @noinspection PhpUnused */
    protected function get_column_types(): ColumnTypes {
        return $this->sheet_module->sheet_column_types;
    }

    /** @noinspection PhpUnused */
    protected function get_index_types(): IndexTypes {
        return $this->sheet_module->index_types;
    }

    /** @noinspection PhpUnused */
    protected function get_index_type(): string {
        return 'elastic';
    }

    /** @noinspection PhpUnused */
    protected function get_index(): Index {
        return Index::new([
            'class' => $this->index_types[$this->index_type],
            'type' => $this->index_type,
            'parent' => $this,
        ]);
    }

    /** @noinspection PhpUnused */
    protected function get_singular_name(): string {
        return mb_substr($this->name, 0, mb_strlen($this->name) - 1);
    }

    /** @noinspection PhpUnused */
    protected function get_column_config(): array {
        return [];
    }

    /** @noinspection PhpUnused */
    protected function get_columns(): array {
        $result = [];

        foreach ($this->column_config as $name => $data) {
            if (!isset($data['type'])) {
                throw new InvalidDefinition(osm_t(
                    "No type specified for ':sheet.:column' sheet column",
                    ['sheet' => $this->name, 'column' => $name]));
            }

            $type = "{$this->type}__{$data['type']}";

            $data['name'] = $name;
            $data['parent'] = $this;
            $data['class'] = $this->column_types[$type];
            $result[$name] = Column::new($data);
        }

        unset($this->column_config);

        return $result;
    }

    /** @noinspection PhpUnused */
    protected function get_primary_column(): Column {
        $result = null;

        foreach ($this->columns as $column) {
            if ($column->primary) {
                if ($result) {
                    throw new InvalidDefinition(osm_t(
                        "Sheet ':sheet' has more than one primary column",
                        ['sheet' => $this->name]));
                }

                $result = $column;
            }
        }

        if (!$result) {
            throw new InvalidDefinition(osm_t(
                "Sheet ':sheet' has no primary column",
                ['sheet' => $this->name]));
        }

        return $result;
    }

    public function create(): void {
        $this->index->create();
    }

    public function drop(): void {
        $this->index->drop();
    }
}