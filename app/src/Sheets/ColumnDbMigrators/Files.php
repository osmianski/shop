<?php

declare(strict_types=1);

namespace App\Sheets\ColumnDbMigrators;

use Osm\Core\App;
use Osm\Data\Tables\Blueprint;

/**
 * Dependencies:
 *
 * @property FileBackReference $file_back_reference @required
 */
class Files extends Migrator
{
    /** @noinspection PhpUnused */
    protected function get_file_back_reference(): FileBackReference {
        global $osm_app; /* @var App $osm_app */

        return $osm_app[FileBackReference::class];
    }

    public function afterAdding() {
        $tableName = "{$this->sheet->name}__{$this->column->name}";

        $this->db->create($tableName, function (Blueprint $table) {
            $table->int($this->back_reference_name)
                ->title($this->back_reference_name)
                ->unsigned()->required()
                ->references($this->back_reference_formula)
                ->on_delete('cascade');

            $table->string('value')->title("Value");
            $table->string('title')->title("Title");
            $table->int('position')->title("Position")
                ->unsigned();
        });

        $this->file_back_reference->create($this->back_reference_name,
            $this->back_reference_formula);
    }
}