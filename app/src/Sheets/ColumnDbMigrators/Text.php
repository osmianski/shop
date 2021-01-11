<?php

declare(strict_types=1);

namespace App\Sheets\ColumnDbMigrators;

class Text extends Migrator
{
    public function createWhileCreatingTable() {
        $this->table
            ->text($this->column->name)
            ->title($this->column->name);
    }
}