<?php

declare(strict_types=1);

namespace App\Sheets\ColumnDbMigrators;

class Price extends Migrator
{
    public function createWhileCreatingTable() {
        $this->table
            ->decimal($this->column->name)
            ->title($this->column->name)
            ->required($this->column->required ?? false);
    }
}