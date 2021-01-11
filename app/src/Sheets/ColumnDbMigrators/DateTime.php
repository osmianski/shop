<?php

declare(strict_types=1);

namespace App\Sheets\ColumnDbMigrators;

class DateTime extends Migrator
{
    public function createWhileCreatingTable() {
        $this->table
            ->datetime($this->column->name)
            ->title($this->column->name)
            ->required($this->column->required ?? false);
    }
}