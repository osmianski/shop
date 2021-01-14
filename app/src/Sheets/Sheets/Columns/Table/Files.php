<?php

declare(strict_types=1);

namespace App\Sheets\Sheets\Columns\Table;

use Osm\Data\Tables\Blueprint;

class Files extends Column
{
    public function afterCreated() {
        $tableName = "{$this->parent->name}__{$this->name}";

        $this->db->create($tableName, function (Blueprint $table) {
            $this->createBackReference($table);
            $table->int('value')->unsigned()->title("Value")
                ->references('files.id')->on_delete('cascade')
                ->required();
            $table->string('title')->title("Title");
            $table->int('position')->title("Position")
                ->unsigned();
        });

        $this->db->alter('files', function (Blueprint $table) {
            $this->createBackReference($table, null, false);
        });
    }
}