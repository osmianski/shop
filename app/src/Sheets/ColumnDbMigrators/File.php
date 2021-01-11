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
class File extends Migrator
{
    /** @noinspection PhpUnused */
    protected function get_file_back_reference(): FileBackReference {
        global $osm_app; /* @var App $osm_app */

        return $osm_app[FileBackReference::class];
    }

    public function createWhileCreatingTable() {
        $this->table
            ->int($this->column->name)
            ->title($this->column->name)
            ->unsigned()
            ->references('files.id')
            ->required($this->column->required ?? false);
    }

    public function afterAdding() {
        $this->file_back_reference->create($this->back_reference_name,
            $this->back_reference_formula);
    }
}