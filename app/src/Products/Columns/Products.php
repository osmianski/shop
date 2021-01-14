<?php

declare(strict_types=1);

namespace App\Products\Columns;

use App\Sheets\Sheets\Columns\Table\Column;
use Osm\Data\Tables\Blueprint;

class Products extends Column
{
    public function afterCreated() {
        $tableName = "{$this->parent->name}__{$this->name}";

        $this->db->create($tableName, function (Blueprint $table) {
            $this->createBackReference($table);
            $this->createBackReference($table, 'value');
            $table->int('position')->unsigned()->title("Position");
        });
    }
}