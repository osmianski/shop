<?php

declare(strict_types=1);

namespace App\Products\ColumnDbMigrators;

use App\Sheets\ColumnDbMigrators\Migrator;
use Osm\Data\Tables\Blueprint;

class Products extends Migrator
{
    public function afterAdding() {
        $tableName = "{$this->sheet->name}__{$this->column->name}";

        $this->db->create($tableName, function (Blueprint $table) {
            $table->int($this->back_reference_name)
                ->title($this->back_reference_name)
                ->unsigned()->required()
                ->references($this->back_reference_formula)
                ->on_delete('cascade');

            $table->int('value')->title("Value")
                ->unsigned()->required()
                ->references('products.id')
                ->on_delete('cascade');
            $table->int('position')->title("Position")
                ->unsigned();
        });
    }
}