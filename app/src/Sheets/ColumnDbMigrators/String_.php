<?php

declare(strict_types=1);

namespace App\Sheets\ColumnDbMigrators;

class String_ extends Migrator
{
    public function createWhileCreatingTable() {
        $this->table
            ->string($this->column->name)
            ->title($this->column->name)
            ->required($this->column->required ?? false);
    }
}