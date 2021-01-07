<?php

namespace App\Products;

use App\Products\Columns;
use App\Products\Columns\Column;
use App\Products\Exceptions\UnknownColumn;
use App\Sheets\Sheet;
use Osm\Core\App;
use Osm\Data\TableQueries\TableQuery;
use Osm\Framework\Db\Db;

/**
 * @property Column[] $columns @required
 * @property string $table_name @required
 *
 * Dependencies:
 *
 * @property Db|TableQuery[] $db @required
 */
class Products extends Sheet
{

    protected function default($property): mixed {
        global $osm_app; /* @var App $osm_app */

        switch ($property) {
            case 'columns': return [
                'sku' => Columns\Column::new([], 'sku', $this),
                'title' => Columns\Column::new([], 'title', $this),
                'platform' => Columns\StringSelect::new([
                    'options' => [
                        'magento1' => 'Magento 1.x',
                        'magento2' => 'Magento 2.x',
                        'osmshop' => 'Osm Shop',
                        'osm' => 'Osm Framework',
                    ],
                ], 'platform', $this),
            ];
            case 'table_name': return $this->name;

            case 'db': return $osm_app->db;
        }
        return parent::default($property);
    }

    public function insert($values) {
        $rawValues = [];

        foreach ($values as $columnName => $value) {
            $this->getColumn($columnName)->pack($rawValues, $value);
        }

        return $this->db[$this->table_name]->insert($rawValues);
    }

    public function query(): Query {
        return Query::new();
    }

    public function search($text): Query {
        return $this->query()->search($text);
    }

    /**
     * @param string $name
     * @return Column
     */
    protected function getColumn($name) {
        if (!isset($this->columns[$name])) {
            throw new UnknownColumn(osm_t("Unknown sheet column ':sheet.:column'", [
                'sheet' => $this->name,
                'column' => $name,
            ]));
        }

        return $this->columns[$name];
    }
}