<?php

declare(strict_types=1);

namespace App\Sheets\Sheets\Columns\Table;

use Osm\Data\Tables\Blueprint;

/**
 * Computed:
 *
 * @property string $table_name @required
 */
class Files extends Column
{
    /** @noinspection PhpUnused */
    protected function get_table_name(): string {
        return "{$this->parent->name}__{$this->name}";
    }

    public function afterCreated(): void {
        $this->db->create($this->table_name, function (Blueprint $table) {
            $this->createBackReference($table);
            $table->int('value')->unsigned()->title("Value")
                ->references('files.id')->on_delete('cascade')
                ->required();
            $table->string('title')->title("Title");
            $table->int('sort_order')->title("Sort Order")
                ->unsigned();
        });

        $this->db->alter('files', function (Blueprint $table) {
            $this->createBackReference($table, null, false);
        });
    }

    public function beforeDropping(): void {
        $this->db->alter('files', function (Blueprint $table) {
            $this->dropBackReference($table);
        });

        $this->db->drop($this->table_name);
    }
}