<?php

namespace App\Products;

use App\Products\Columns\Column;
use App\Products\Exceptions\UnknownColumn;
use Osm\Core\App;
use Osm\Core\Exceptions\NotImplemented;
use Osm\Core\Object_;
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
class Products extends Object_
{
    public $name = 'products';

    protected function default($property) {
        global $osm_app; /* @var App $osm_app */

        switch ($property) {
            case 'columns': return [
                'sku' => Column::new([], 'sku', $this),
                'title' => Column::new([], 'title', $this),
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

        throw new NotImplemented();
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