<?php

declare(strict_types=1);

namespace App\Sheets\ColumnDbMigrators;

class Bool_ extends Migrator
{
    public function createWhileCreatingTable() {
        $this->table
            ->bool($this->column->name)
            ->title($this->column->name)
            ->required()
            ->value(false);
    }
}