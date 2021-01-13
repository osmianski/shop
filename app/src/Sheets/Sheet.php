<?php

namespace App\Sheets;

use App\Sheets\Exceptions\InvalidDefinition;
use App\Sheets\SearchEngines\Elastic;
use App\Sheets\SearchEngines\SearchEngine;
use Osm\Core\Object_;

/**
 * @property string $name @required @part
 * @property string $singular_name @required @part
 * @property SearchEngine $search_engine @required @part
 * @property array $column_config @required @part
 * @property array|Column[] $columns @required @part
 * @property Column $primary_column @required
 */
class Sheet extends Object_
{
    /** @noinspection PhpUnused */
    protected function get_search_engine(): SearchEngine {
        return Elastic::new([
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
            $data['name'] = $name;
            $data['parent'] = $this;
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
}