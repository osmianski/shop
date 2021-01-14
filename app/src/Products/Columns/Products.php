<?php

declare(strict_types=1);

namespace App\Products\Columns;

use App\Sheets\Sheets\Columns\Table\Column;
use Osm\Data\Tables\Blueprint;

/**
 * Computed:
 *
 * @property string $table_name @required
 */
class Products extends Column
{
    /** @noinspection PhpUnused */
    protected function get_table_name(): string {
        return "{$this->parent->name}__{$this->name}";
    }

    public function afterCreated(): void {
        $this->db->create($this->table_name, function (Blueprint $table) {
            $this->createBackReference($table);
            $this->createBackReference($table, 'value');
            $table->int('sort_order')->unsigned()->title("Sort Order");
        });
    }

    public function beforeDropping(): void {
        $this->db->drop($this->table_name);
    }
}