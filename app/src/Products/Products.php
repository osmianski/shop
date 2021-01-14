<?php

namespace App\Products;

use App\Products\Columns\Column;
use App\Products\Exceptions\UnknownColumn;
use App\Sheets\Sheets\Table;

class Products extends Table
{
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